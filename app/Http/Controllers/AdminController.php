<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Tag;


class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::with(['category', 'tags']);
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                  ->orwhere('last_name', 'like', "%{$keyword}%")
                  ->orwhere('email', 'like', "%{$keyword}%");
            });
        }  

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);    
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }
        $categories = Category::all();
        $tags = Tag::all();

        $contacts = $query->paginate(7)->withQueryString();

        return view('admin.index', compact('contacts', 'categories', 'tags'));

        
    }

    public function show(Contact $contact)
    {
        $contact->load(['category', 'tags']);

        return view('admin.show', compact('contact'));

    }

    public function destroy(Contact $contact)
    {
        $contact->tags()->detach();
        $contact->delete();

        return redirect('/admin');
    }

    public function storeTag(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Tag::create([
            'name' => $request->name,
        ]);

        return redirect('/admin');
    }

    public function destroyTag(Tag $tag)
    {
        $tag->contacts()->detach();
        $tag->delete();

        return redirect('/admin');

    }

    public function editTag(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));

    }
    public function updateTag(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $tag->update([
            'name' => $request->name,

        ]);

        return redirect('/admin');

    }

    public function export(Request $request)
    {
        $query = Contact::with(['category', 'tags']);

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                    ->orwhere('last_name', 'like', "%{$keyword}%")
                    ->orwhere('email', 'like', "%{$keyword}%");

            });

        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);        
        }

        if ($request->filled('category_id')) {
            $query->where('categry_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->get();

        $csvHeader = [
            '名前',
            '性別',
            'メールアドレス',
            '電話番号',
            '住所',
            'お問い合わせ種類',
            'お問い合わせ内容',
        ];

        $callback = function () use ($contacts, $csvHeader) {
            $file = fopen('php://output', 'w');
            fwrite($file, "\xEF\xBB\xBF");

            fputcsv($file, $csvHeader);

            foreach ($contacts as $contact) {
                fputcsv($file, [
                    $contact->first_name . ' ' . $contact->last_name,
                    $contact->gender,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->category?->content,
                    $contact->detail, 
                ]);
                
            }

            fclose($file);
        };

        return response()->streamDownload($callback, 'contact.csv');

    }

}
