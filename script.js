const slider = document.querySelector('.slider');
const images = slider.querySelectorAll('img');
const prevButton = slider.querySelector('.prev');
const nextButton = slider.querySelector('.next');
let index = 0;

function showImage(index) {
  images.forEach(image => image.classList.remove('active'));
  images[index].classList.add('active');
}

function nextImage() {
  index++;
  if (index >= images.length) {
    index = 0;
  }
  showImage(index);
}

function prevImage() {
  index--;
  if (index < 0) {
    index = images.length - 1;
  }
  showImage(index);
}

showImage(index);

nextButton.addEventListener('click', nextImage);
prevButton.addEventListener('click', prevImage);
