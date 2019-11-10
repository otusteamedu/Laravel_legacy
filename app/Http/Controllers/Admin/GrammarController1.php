<?php
//
//namespace App\Http\Controllers\Admin;
//
//use App\Http\Controllers\Controller;
//use App\GrammarModel;
//use Request;
//
//
//class GrammarController extends Controller
//{
//    public static function getList()
//    {
//      //  $g= new Grammar();
//        dd(Grammar());
//        $list = GrammarModel::getList();
//        return view('admin.grammar_list')->with(['list' => $list]);
//    }
//
//    public static function getDetail(string $code)
//    {
//        $detail = GrammarModel::getDetail($code);
//        return view('admin.grammar_detail')->with(['detail' => $detail]);
//    }
//
//    public static function savePage()
//    {
//        $data = [
//            'name' => Request::get('name'),
//            'code' => Request::get('code'),
//            'grammar_text' => Request::get('grammar_text'),
//            'arabic_text' => Request::get('arabic_text'),
//            'title' => Request::get('title'),
//            'meta_keywords' => Request::get('meta_keywords'),
//            'meta_description' => Request::get('meta_description'),
//        ];
//
//        $id=Request::get('id');
//        $message=[];
//        $error=[];
//        if(GrammarModel::updateData($id,$data)){
//            $message="Данные обовлены";
//        }else{
//            $error ="Произошла ошибка";
//        }
//        $detail=GrammarModel::getDetailId($id);
//        return view('admin.grammar_detail')->with(['detail' => $detail,'message'=>$message,'error'=>$error]);
//    }
//}
