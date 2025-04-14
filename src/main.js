//citation

const citation = document.querySelector('#citation')

const aleatoire = Math.floor(Math.random()*6)

switch(aleatoire){
    case 0:citation.append("“L’argent peut vous acheter un beau chien, mais seul l’amour peut lui faire bouger sa queue.” Kinky Friedman");
        break;
    case 1:citation.append("“Tout le monde pense qu’ils ont le meilleur chien et ils ont tous raison.” W.R. Purche");
        break;
    case 2:citation.append("“Les chiens parlent, mais seulement à ceux qui savent écouter.” Orhan Pamuk");
        break;
    case 3:citation.append("“Plus je vois les hommes, plus j’admire les chiens.” Madame de Sévigné");
        break;
    case 4:citation.append("“Plus on apprend à connaître l’homme, plus on apprend à estimer le chien.” Alphonse Toussenel");
        break;
    case 5:citation.append("“Partout où il y a un malheureux, Dieu envoie un chien.” Alphonse De Lamartine");
        break;
    default:
}

//menu burger

const burger = document.getElementById('burger');
const navLinks = document.getElementById('nav-links');
const closeBtn = document.getElementById('close-btn');

//ouvrir le menu

burger.addEventListener('click', () => {
    navLinks.classList.toggle('active');
});

// Fermer le menu

closeBtn.addEventListener('click', () => {
    navLinks.classList.remove('active');
});
