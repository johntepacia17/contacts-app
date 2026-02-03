document.addEventListener("DOMContentLoaded", () => {
  const input = document.getElementById("contactSearch");
  const clearBtn = document.getElementById("contactSearchClear");
  const tbody = document.getElementById("contactsTbody");
  const paginationWrap = document.getElementById("paginationWrap");
  const searchStatus = document.getElementById("searchStatus");

  if (!input || !tbody) return;

  let timer = null;
  let abortCtrl = null;

  // Snapshot initial server-rendered HTML
  const initialTbodyHtml = tbody.innerHTML;

  const setStatus = (msg) => {
    if (searchStatus) searchStatus.textContent = msg || "";
  };

  const escapeHtml = (s) =>
    String(s ?? "")
      .replaceAll("&", "&amp;")
      .replaceAll("<", "&lt;")
      .replaceAll(">", "&gt;")
      .replaceAll('"', "&quot;")
      .replaceAll("'", "&#039;");

  const showLoadingRow = () => {
    tbody.innerHTML = `
      <tr>
        <td colspan="5" class="text-center text-muted py-4">
          Searching...
        </td>
      </tr>
    `;
  };

  const showNoResultsRow = () => {
    tbody.innerHTML = `
      <tr>
        <td colspan="5" class="text-center text-muted py-4">
          No results
        </td>
      </tr>
    `;
  };

  const restoreInitial = () => {
    tbody.innerHTML = initialTbodyHtml;
    paginationWrap?.classList.remove("d-none");
    setStatus("");
  };

  const renderRows = (items) => {
    if (!items.length) {
      showNoResultsRow();
      return;
    }

    tbody.innerHTML = items
      .map((c) => `
        <tr>
          <td class="fw-semibold">${escapeHtml(c.name)}</td>
          <td>${escapeHtml(c.company || "—")}</td>
          <td>${escapeHtml(c.email || "—")}</td>
          <td>${escapeHtml(c.phone || "—")}</td>
          <td class="text-end">
            <a class="btn btn-sm btn-outline-primary" href="/contacts/${c.id}/edit">
              Edit
            </a>

            <button
              class="btn btn-sm btn-outline-danger ms-2 js-contact-delete"
              data-bs-toggle="modal"
              data-bs-target="#deleteContactModal"
              data-contact-id="${c.id}"
              data-contact-name="${escapeHtml(c.name)}"
              type="button"
            >
              Delete
            </button>

            <form id="delete-form-${c.id}" class="d-none" method="POST" action="/contacts/${c.id}">
              <input type="hidden" name="_method" value="DELETE">
            </form>
          </td>
        </tr>
      `)
      .join("");
  };

  const doSearch = async () => {
    const q = input.value.trim();

    // Restore server-rendered list if empty
    if (!q) {
      if (abortCtrl) abortCtrl.abort();
      restoreInitial();
      return;
    }

    paginationWrap?.classList.add("d-none");

    // Cancel previous request
    if (abortCtrl) abortCtrl.abort();
    abortCtrl = new AbortController();

    setStatus("Searching…");
    showLoadingRow();

    try {
      const res = await window.axios.get("/contacts/search", {
        params: { q },
        signal: abortCtrl.signal,
      });

      if (res.data?.ok) {
        renderRows(res.data.data || []);
        setStatus(`Results for "${q}"`);
      } else {
        showNoResultsRow();
        setStatus("No results");
      }
    } catch (err) {
      if (err.name === "CanceledError") return;

      tbody.innerHTML = `
        <tr>
          <td colspan="5" class="text-center text-danger py-4">
            Search failed. Please try again.
          </td>
        </tr>
      `;
      setStatus("Search error");
    }
  };

  input.addEventListener("input", () => {
    clearTimeout(timer);
    timer = setTimeout(doSearch, 250);
  });

  clearBtn?.addEventListener("click", () => {
    input.value = "";
    doSearch();
    input.focus();
  });
});
