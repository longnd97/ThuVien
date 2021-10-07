<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Student;
use http\Env\Response;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    function index()
    {
        $borrows = Borrow::all();
        return view('backend.admin.borrows.list', compact('borrows'));
    }

    function create()
    {
        $books = Book::all();
        return view('backend.admin.borrows.add', compact('books'));
    }

    function searchStudent(Request $request)
    {
        $keyword = $request->keyword;
        $students = Student::where('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('student_code', 'LIKE', '%' . $keyword . '%')
            ->get();
        return response()->json($students);
    }

    function findStudent($id)
    {
        $student = Student::find($id);
        return response()->json($student);
    }

    function searchBook(Request $request)
    {
        $keyword = $request->keyword;
        $books = Book::where('name', 'LIKE', '%' . $keyword . '%')->get();
        return response()->json($books);
    }

    function findBook($id)
    {
        $book = Book::find($id);
        return response()->json($book);
    }

    function store(Request $request)
    {
        if ($this->checkStatusBook($request->book_status)) {
            $borrow = new Borrow();
            $borrow->student_id = $request->student_id;
            $borrow->borrow_date = $request->borrow_date;
            $borrow->return_date = $request->return_date;
            $borrow->status = BorrowConstant::BORROWED;
            $borrow->save();
            $borrow->books()->sync($request->book_id);
            $borrow->books()->update(['status' => BookConstant::BOOK_NOT_BORROWED]);
            return response()->json('Cho mượn thành công');
        } else {
            return response()->json('Sách chưa thể mượn');
        }
    }

    function indexReturn()
    {
        $borrows = Borrow::all();
        return view('backend.admin.borrows.list-return', compact('borrows'));
    }

    function confirmReturn($id)
    {
        $borrow = Borrow::find($id);
        $borrow->books()->update(['status' => BookConstant::BOOK_BORROWED]);
        $borrow->status = BorrowConstant::BORROW_RETURN;
        $borrow->save();
        return response()->json('Xác nhận thành công');
    }

    function checkStatusBook($status)
    {
        if ($status == BookConstant::BOOK_BORROWED) {
            return true;
        }
        return false;
    }
}
