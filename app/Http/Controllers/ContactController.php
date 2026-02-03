<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::query()
            ->where('user_id', $request->user()->id)
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => ['required', 'string', 'max:120'],
            'company' => ['nullable', 'string', 'max:120'],
            'email'   => ['nullable', 'email', 'max:190'],
            'phone'   => ['nullable', 'string', 'max:50'],
        ]);

        $request->user()->contacts()->create($data);

        return redirect()->route('contacts.index')->with('status', 'Contact created.');
    }

    public function edit(Request $request, Contact $contact)
    {
        $this->authorizeOwner($request, $contact);
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $this->authorizeOwner($request, $contact);

        $data = $request->validate([
            'name'    => ['required', 'string', 'max:120'],
            'company' => ['nullable', 'string', 'max:120'],
            'email'   => ['nullable', 'email', 'max:190'],
            'phone'   => ['nullable', 'string', 'max:50'],
        ]);

        $contact->update($data);

        return redirect()->route('contacts.index')->with('status', 'Contact updated.');
    }

    public function destroy(Request $request, Contact $contact)
    {
        $this->authorizeOwner($request, $contact);
        $contact->delete();

        return redirect()->route('contacts.index')->with('status', 'Contact deleted.');
    }

    // AJAX search: keyword matches name/company/email/phone
    public function search(Request $request)
    {
        $q = (string) $request->query('q', '');

        // basic sanitization
        $q = trim(mb_substr($q, 0, 80));

        $query = Contact::query()->where('user_id', $request->user()->id);

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $like = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $q) . '%';
                $sub->where('name', 'like', $like)
                    ->orWhere('company', 'like', $like)
                    ->orWhere('email', 'like', $like)
                    ->orWhere('phone', 'like', $like);
            });
        }

        $contacts = $query->orderBy('name')->limit(30)->get([
            'id', 'name', 'company', 'email', 'phone'
        ]);

        return response()->json([
            'ok' => true,
            'data' => $contacts,
        ]);
    }

    private function authorizeOwner(Request $request, Contact $contact): void
    {
        if ($contact->user_id !== $request->user()->id) {
            abort(403);
        }
    }
}
