
const header = document.querySelector('header');
const blogList = document.getElementById('blogList');

window.addEventListener('scroll', function () {
  if (window.scrollY > blogList.offsetTop) {
    header.classList.add('header-fixed');
    return;
  }
  header.classList.remove('header-fixed');
});
