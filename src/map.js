//sélection des différents éléments

const map = document.querySelector('#map');

const paths = map.querySelectorAll('.mapImage a');

const links = map.querySelectorAll('.mapList a');

//on créé une fonction qui prendra en paramètre l'id de l'élément à activer

const activeArea = function(id){
    map.querySelectorAll('.is-active').forEach(function (item){
        //on retire la classe "is-active"
        item.classList.remove('is-active');
    })
    if (id !== undefined) {
        //on rajoute la classe "is-active"
        document.querySelector('#list' + id).classList.add('is-active');
        document.querySelector('#region' + id).classList.add('is-active');
    }
}

paths.forEach(function (path){
    path.addEventListener('mouseenter', function (){
        //on enlève le terme "région" pour ne sélectionner que l'id
        const id = this.id.replace('region','');
        activeArea(id);
    })
})

links.forEach(function (link) {
    link.addEventListener('mouseenter', function(){
        //on enlève le terme "list" pour ne sélectionner que l'id
        const id = this.id.replace('list','');
        activeArea(id);
    })
})

//permet de déselectionner une zone de la carte lorsqu'on arrète de la survoler

map.addEventListener('mouseover', function (){
    activeArea();
})



// //zoom sur région

// const region = document.querySelector('#region') 

// const regionZoom = function(path){
//     path.addEventListener('click', function(){
//         path.style.width = 'scale(2)';
//     })
// }

// activeArea(regionZoom());