import articles from './articles.js';

export function affichageArticles() {
  const galleryContainer = document.getElementById('articles');
  galleryContainer.innerHTML = '';

  const data = articles.getDataArticles();

  data.then((dataArticles) => {
    dataArticles.articles.forEach((article, index) => {
        //trié par date de création dans l'ordre chronologique croissant
        dataArticles.articles.sort(function(a,b){
            return new Date(b.date_creation) - new Date(a.date_creation);
        });

        //inverse l'ordre de daataArticles.articles
        
  
      const titre = "Titre : "+ article.titre+ " ";
      const date = "Creation : "+ article.date_creation + " ";
      const auteur = "Auteur : "+article.auteur + " ";

      const catTitreElement = document.createElement('cat_titre');
      catTitreElement.textContent = titre;
      galleryContainer.appendChild(catTitreElement);

      const catAuteurElement = document.createElement('cat_auteur');
      catAuteurElement.textContent = auteur;
      galleryContainer.appendChild(catAuteurElement);

      const catCreaElement = document.createElement('cat_crea');
      catCreaElement.textContent = date;
      galleryContainer.appendChild(catCreaElement);

      if (index !== dataArticles.articles.length - 1) {
        const separatorDiv = document.createElement('div');
        separatorDiv.classList.add('articles_separateur');
        galleryContainer.appendChild(separatorDiv);
      }
    });
  });
}

