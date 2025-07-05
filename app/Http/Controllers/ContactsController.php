<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\ContactRequest;
use App\Jobs\NotifyContactJob;
use App\Models\Contact;

class ContactsController extends Controller
{
    public function index() {
        $contacts = Contact::paginate(10);

        return Inertia::render('Contacts/Index', [
            'contacts' => $contacts
        ]);
    }

    public function create() {
        return Inertia::render('Contacts/Create');
    }

    public function store(Request $request, ContactRequest $contact_request) {
        $data = $contact_request->validated();

        $contact = Contact::firstOrCreate(
            ['email' => $data['email']],
            [
                'name' => $data['name'],
                'phone' => preg_replace('/\D/', '', $data['phone']),
            ]
        );

        return redirect()->route('contacts.index')->with('success', 'Contato salvo com sucesso!');
    }

    public function edit($id) {
        $contact = Contact::findOrFail($id);

        return Inertia::render('Contacts/Edit', [
            'contact' => $contact
        ]);
    }

    public function update(ContactRequest $contact_request, $id) {
        $data = $contact_request->validated();

        $contact = Contact::findOrFail($id);

        $contact->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => preg_replace('/\D/', '', $data['phone']),
        ]);

        return redirect()->route('contacts.index')->with('success', 'Contato atualizado com sucesso!');
    }

    public function destroy($id) {
        $contact = Contact::findOrFail($id);

        NotifyContactJob::dispatch($contact);

        $contact->delete();
 
        return redirect()->route('contacts.index')->with('success', 'Contato excluído com sucesso!');
    }
}
