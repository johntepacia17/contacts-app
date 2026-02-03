@forelse($contacts as $contact)
  <tr>
    <td class="fw-semibold">{{ $contact->name }}</td>
    <td>{{ $contact->company ?? '—' }}</td>
    <td>{{ $contact->email ?? '—' }}</td>
    <td>{{ $contact->phone ?? '—' }}</td>
    <td class="text-end">
      <a class="btn btn-sm btn-outline-primary" href="{{ route('contacts.edit', $contact) }}">Edit</a>

      <button
        type="button"
        class="btn btn-sm btn-outline-danger ms-2 js-contact-delete"
        data-bs-toggle="modal"
        data-bs-target="#deleteContactModal"
        data-contact-id="{{ $contact->id }}"
        data-contact-name="{{ $contact->name }}"
        >
        Delete
      </button>


      <form
        id="delete-form-{{ $contact->id }}"
        class="d-none"
        method="POST"
        action="{{ route('contacts.destroy', $contact) }}"
      >
        @csrf
        @method('DELETE')
      </form>
    </td>
  </tr>
@empty
  <tr>
    <td colspan="5" class="text-center text-muted py-4">No contacts yet.</td>
  </tr>
@endforelse
