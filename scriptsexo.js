document.addEventListener('DOMContentLoaded', function() {
    let button = document.querySelector('#add-btn');
  
    button.addEventListener('click', function(event) {
      let field = document.getElementById('text-field');
      let container = document.querySelector('.container .team');
      let htmlData = 
        `<div class="column">
        <figure><img /></figure>
        <p class="name">` + field.value + `</p>
        </div>`
      ;
        


      container.innerHTML = container.innerHTML + htmlData;
      //alert(container.length)
      //alert(field.value)
    });
  });