<?php

namespace App\Http\Controllers;

use App\Mail\RequestCreated;
use App\Mail\UserCreated;
use App\Mail\UserRemindPassword;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Auth;


class ApiController extends Controller
{
	public function __construct()
	{
		$this->middleware('api_token');
	}

	/**
	 * Helper для возврата json в требуемом формате
	 * @param $status
	 * @param $message
	 * @param array $fields
	 * @return \Illuminate\Http\JsonResponse
	 */
	public static function answer($status, $message, $fields = array())
	{
		return response()->json([
			'status' => $status,
			'message' => $message,
			'data' => $fields
		]);
	}

	public function authorization()
	{
		$email = User::getEmailByPhone(request('phone'));

		if (! auth()->attempt(['email' => $email, 'password' => request('password')], true)) {
			return $this->answer('error', 'Некорректный логин или пароль');
		}
		if ( auth()->user()->status != User::STATUS_ACCEPTED) {
			auth()->logout();
			return $this->answer('error', 'Пользователь не подтвержден');
		}

		$data = ['remember_token' => auth()->user()->getRememberToken()];

		return $this->answer('ok', 'Пользователь успешно авторизован', $data);
	}

	public function password()
	{
		if ($user = User::where('email', request('email'))->first()) {
			$password = substr(md5(rand()), 0, 7);
			$user->password = bcrypt($password);
			$user->save();
			\Mail::to($user)->send(new UserRemindPassword($user, $password));
			return $this->answer('ok', 'Новый пароль отправлен на e-mail');
		} else {
			return $this->answer('error', 'E-mail не найден');
		}
	}

	public function register(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'phone' => 'required|unique:users',
			'password' => 'required',
			'company' => 'required'
		]);

		if ($validator->fails()) {
			$errors = $validator->errors()->all();
			return $this->answer('error',  current($errors));
		}

		User::create([
			'name' => request('name'),
			'email' => request('email'),
			'phone' => request('phone'),
			'password' => bcrypt(request('password')),
			'status' => 'New',
			'company' => request('company'),
		]);

        \Mail::to('app@somedomain.com')->cc('mail@somedomain.com')->send(new UserCreated());
		return $this->answer('ok',  'Пользователь успешно зарегистрирован');
	}

	public function personal(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'remember_token' => 'required',
			'phone' => 'required',
		]);
		if ($validator->fails()) {
			$errors = $validator->errors()->all();
			return $this->answer('error',  current($errors));
		}

		if ($user = User::where('phone', request('phone'))
			->where('remember_token', request('remember_token'))
			->first()
		) {
			$data = $user->toArray();
			unset($data['status']);
			unset($data['is_manager']);
			return $this->answer('ok', 'Получены данные пользователя', $data);
		} else {
			return $this->answer('error', 'Авторизованный пользоатель не найден. Необходимо обновить токен');
		}
	}

	public function personalUpdate(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'remember_token' => 'required',
			'phone' => 'required',
		]);
		if ($validator->fails()) {
			$errors = $validator->errors()->all();
			return $this->answer('error',  current($errors));
		}

		if ($user = User::where('remember_token', request('remember_token'))
			->first()
		) {
			$validator = Validator::make($request->all(), [
				'phone' => 'required|unique:users,phone,'.$user->id.',id',
				'name' => 'required',
				'email' => 'required|email|unique:users,email,'.$user->id.',id',
				'password' => 'required_with:password_new',
				'password_new' => 'between:4,10',
				'company' => 'required', // поля нет на экране редактирования в приложении. UPD: раскомментировано
			]);
			if ($validator->fails()) {
				$errors = $validator->errors()->all();
				return $this->answer('error',  current($errors));
			}

			/** проверка корректности старого пароля, если введен новый */
			if (request('password_new')) {
				$email = User::getEmailByPhone(request('phone'));
				$credentials = ['email' => $email, 'password' => request('password')];
				if (!Auth::validate($credentials)) {
					return $this->answer('error', 'Введен неверный старый пароль');
				}
				$user->password = bcrypt(request('password_new'));
			}

			$user->name = request('name');
			$user->phone = request('phone');
			$user->email = request('email');
			$user->company = request('company');
			$user->save();

			return $this->answer('ok', 'Данные пользователя обновлены');

		} else {
			return $this->answer('error', 'Авторизованный пользоатель не найден. Необходимо обновить токен');
		}
	}

	public function orders(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'remember_token' => 'required',
			'phone' => 'required',
		]);
		if ($validator->fails()) {
			$errors = $validator->errors()->all();
			return $this->answer('error',  current($errors));
		}

		if ($user = User::where('phone', request('phone'))
			->where('remember_token', request('remember_token'))
			->first()
		) {
			$orders = $user->orders()->get();
			return $this->answer('ok',  'Получен список заявок', ['orders' => $orders]);
		} else {
			return $this->answer('error', 'Авторизованный пользоатель не найден. Необходимо обновить токен');
		}
	}

	public function create(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'remember_token' => 'required',
			'phone' => 'required',
		]);
		if ($validator->fails()) {
			$errors = $validator->errors()->all();
			return $this->answer('error',  current($errors));
		}

		if ($user = User::where('phone', request('phone'))
			->where('remember_token', request('remember_token'))
			->first()
		) {
			$validator = Validator::make($request->all(), [
				'customer_name' => 'required',
				'customer_phone' => 'required',
				'research_area' => 'required',
				'comment' => 'required',
			]);
			if ($validator->fails()) {
				$errors = $validator->errors()->all();
				return $this->answer('error',  current($errors));
			}
			$user->publish(
				new Order(array_merge(['status' => 'New'], request(['customer_name', 'customer_phone', 'research_area', 'comment'])))
			);
            \Mail::to('app@somedomain.com')->cc('mail@somedomain.com')->send(new RequestCreated());
			return $this->answer('ok',  'Заявка отправлена');

		} else {
			return $this->answer('error', 'Авторизованный пользоатель не найден. Необходимо обновить токен');
		}
	}

	public function delete(Order $order, Request $request)
	{
		$validator = Validator::make($request->all(), [
			'remember_token' => 'required',
			'phone' => 'required',
		]);
		if ($validator->fails()) {
			$errors = $validator->errors()->all();
			return $this->answer('error',  current($errors));
		}

		if ($user = User::where('phone', request('phone'))
			->where('remember_token', request('remember_token'))
			->first()
		) {
			if ($order->user->id == $user->id) {
				$order->delete();
				return $this->answer('ok',  'Заявка удалена');
			} else {
				return $this->answer('error',  'Заявка не принадлежит данному пользователю');
			}
		} else {
			return $this->answer('error', 'Авторизованный пользоатель не найден. Необходимо обновить токен');
		}
	}
}
