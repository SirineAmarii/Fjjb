document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.querySelector('.search-input');
  const form = document.querySelector('.search-bar');
  const tbody = document.getElementById('results-table-body');

  
  form.addEventListener('submit', function (e) {
    e.preventDefault();
  });

  searchInput.addEventListener('input', function () {
    const query = searchInput.value.trim();
    const url = searchInput.getAttribute('data-url');

    fetch(`${url}?q=${encodeURIComponent(query)}`)
      .then(response => response.json())
      .then(results => {
        tbody.innerHTML = ''; 

        if (results.length > 0) {
          results.forEach(result => {
            const row = document.createElement('tr');
            row.innerHTML = `
              <td>${result.competition_name}</td>
              <td>${result.category}</td>
              <td>
                <div style="display: flex; align-items: center; gap: 8px;">
                  <img src="/uploads/users/${result.photo ?? 'default.png'}" 
                       alt="Photo" width="40" height="40" style="object-fit: cover; border-radius: 50%;">
                  ${result.first_name} ${result.last_name}
                </div>
              </td>
              <td>${result.club_name}</td>
              <td>${result.position}</td>
            `;
            tbody.appendChild(row);
          });
        } else {
          const row = document.createElement('tr');
          row.innerHTML = `<td colspan="5">Aucun résultat trouvé.</td>`;
          tbody.appendChild(row);
        }
      });
  });
});
