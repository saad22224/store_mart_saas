<?php

namespace App\Http\Controllers\addons;

use App\Helpers\helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuestionAnswer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class QuestionAnswerController extends Controller
{
    public function product_question_answer(Request $request)
    {

        $vendordata = User::where('slug', $request->question_answer_item_slug)->first();
        $product_ques_ans = new QuestionAnswer();
        $product_ques_ans->product_id = $request->question_answer_item_id;
        $product_ques_ans->vendor_id = $vendordata->id;
        $product_ques_ans->question = $request->question;
        $product_ques_ans->save();

        return redirect()->back()->with('success', trans('messages.success'));
    }

    public function question_answer()
    {

        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }

        $product_ques_ans = QuestionAnswer::where('vendor_id', $vendor_id)->with('product')->orderByDesc('id')->get();

        return view('admin.question_answer.product_index', compact('product_ques_ans'));
    }

    public function product_answer(Request $request)
    {

        $product_answer = QuestionAnswer::where('id', $request->id)->first();
        $product_answer->answer = $request->answer;
        $product_answer->save();

        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function delete(Request $request)
    {
        try {
            $delete = QuestionAnswer::where('id', $request->id)->first();
            $delete->delete();
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }
    public function bulk_delete(Request $request)
    {
        try {
            foreach ($request->id as $id) {
                $delete = QuestionAnswer::where('id', $id)->first();
                $delete->delete();
            }
            return response()->json(['status' => 1, 'msg' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'msg' => trans('messages.error')], 200);
        }
    }

}
