<?php

namespace App\Http\Controllers\System\Menu;

use App\Contract\Service\Menu\LinkServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\System\Menu\CreateLinkRequest;
use App\Http\Requests\System\Menu\UpdateLinkRequest;
use App\Model\Menu\Link;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class LinkController
 * @package App\Http\Controllers\System\Menu
 *
 * Контроллер списка ссылок в системном разделе
 */
class LinkController extends Controller
{
    /** @var LinkServiceInterface Сервис ссылок */
    private $linkService;

    public function __construct(LinkServiceInterface $linkService)
    {
        $this->linkService = $linkService;
    }

    /**
     * Страница списка
     * @return Application|Factory|View
     */
    public function index()
    {
        $links = $this->linkService->getList();

        return view('system.links.index', ['links' => $links]);
    }

    /**
     * Страница отображения формы создания
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('system.links.create');
    }

    /**
     * Создание новой ссылки
     * @param CreateLinkRequest $request Запрос
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateLinkRequest $request)
    {
        $data = $request->getData();
        $id = $this->linkService->create($data);
        return redirect()
            ->route('links.index')
            ->with('message', __('link.system.action_result.create', ['id' => $id]));
    }

    /**
     * Карточка ссылки
     * @param Link $link Ссылка
     * @return Application|Factory|View
     */
    public function show(Link $link)
    {
        return view('system.links.show', ['link' => $link]);
    }

    /**
     * Форма редактирования ссылки
     * @param Link $link ссылка
     * @return Application|Factory|View
     */
    public function edit(Link $link)
    {
        return view('system.links.edit', ['link' => $link]);
    }

    /**
     * Обновление ссылки
     * @param UpdateLinkRequest $request запрос
     * @param Link $link ссылка
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateLinkRequest $request, Link $link)
    {
        $data = $request->getData();
        $this->linkService->update($link->id, $data);
        return redirect()
            ->route('links.edit', [$link])
            ->with('message', __('link.system.action_result.update', ['id' => $link->id]));
    }

    /**
     * Удаление ссылки
     * @param Link $link ссылка
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(Link $link)
    {
        $this->linkService->destroy($link->id);
        return redirect()
            ->route('links.index')
            ->with('message', __('link.system.action_result.destroy', ['id' => $link->id]));
    }
}
