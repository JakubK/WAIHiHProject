let items = document.querySelectorAll('.item');
let itemsArray = Array.from(items);

const modal = document.getElementById('modal');
const modalImg = document.getElementById('modal-img')
itemsArray.forEach(x => {
  x.addEventListener("click", function(){
    modal.style.display = "flex";
    modalImg.src = this.childNodes[1].src;
  });
});

document.querySelector('.close-btn').addEventListener("click", function(){
  modal.style.display = "none";
})