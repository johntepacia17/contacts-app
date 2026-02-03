@extends('layouts.app')

@section('content')
<div class="row g-3">
  {{-- Header --}}
  <div class="col-12">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
      <div>
        <h3 class="mb-1">My Contacts</h3>
        <div class="text-muted small">Manage your private contacts (only visible to your account).</div>
      </div>

      <div class="d-flex gap-2">
        <a class="btn btn-primary" href="{{ route('contacts.create') }}">
          <span class="me-1">+</span> Add Contact
        </a>
      </div>
    </div>
  </div>

  {{-- Search Card --}}
  <div class="col-12">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="row g-2 align-items-center">
          <div class="col-12 col-md-8">
            <label for="contactSearch" class="form-label mb-1">Search (AJAX)</label>

            <div class="input-group">
              <span class="input-group-text">🔎</span>
              <input
                id="contactSearch"
                type="text"
                class="form-control"
                placeholder="Search name, company, email, phone..."
                autocomplete="off"
              />
              <button class="btn btn-outline-secondary" type="button" id="contactSearchClear">Clear</button>
            </div>

            <div class="form-text">
              Type to search. Clear input to go back to the paginated list.
            </div>
          </div>

          <div class="col-12 col-md-4 text-md-end">
            <div id="searchStatus" class="small text-muted">
              {{-- JS updates this --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Table --}}
  <div class="col-12">
    <div class="card shadow-sm">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th style="min-width: 180px;">Name</th>
              <th style="min-width: 160px;">Company</th>
              <th style="min-width: 220px;">Email</th>
              <th style="min-width: 140px;">Phone</th>
              <th class="text-end" style="min-width: 160px;">Actions</th>
            </tr>
          </thead>

          {{-- IMPORTANT:
               We render the initial server rows in this tbody.
               JS will replace tbody content during search,
               and restore from the snapshot when cleared.
          --}}
          <tbody id="contactsTbody">
            @include('contacts.partials.rows', ['contacts' => $contacts])
          </tbody>
        </table>
        <!-- Delete Contact Modal -->
        <div class="modal fade" id="deleteContactModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 14px;">
            <div class="modal-header">
                <h5 class="modal-title">Delete contact?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="text-muted">
                You are about to delete <strong id="deleteContactName">this contact</strong>.
                This action cannot be undone.
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmContactDeleteBtn">
                Yes, delete
                </button>
            </div>
            </div>
        </div>
        </div>

      </div>

      <div class="card-body d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
        <div class="text-muted small">
          Showing {{ $contacts->firstItem() ?? 0 }} - {{ $contacts->lastItem() ?? 0 }} of {{ $contacts->total() }}
        </div>
        <div id="paginationWrap">
          {{ $contacts->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
