
const newSort = document.getElementById('newSort');
const oldSort = document.getElementById('oldSort');
const search = document.getElementById('search');

newSort.addEventListener('click', () => {
  alert('新しい順で表示します');
});

oldSort.addEventListener('click', () => {
  alert('古い順で表示します');
});

search.addEventListener('click', () => {
  alert('キーワードで検索しました');
});
