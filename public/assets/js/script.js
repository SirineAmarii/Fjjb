//Barre de recherche

document.addEventListener('DOMContentLoaded', function () {
  const input = document.querySelector('.search-input');
  const results = document.querySelector('.competitions-grid');

  if (!input || !results) return;

  input.addEventListener('input', function () {
    const query = this.value.trim();
    const url = input.dataset.url;

    const xhr = new XMLHttpRequest();
    xhr.open('GET', url + '?q=' + encodeURIComponent(query), true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        results.innerHTML = xhr.responseText;
      }
    };
    xhr.send();
  });
});
