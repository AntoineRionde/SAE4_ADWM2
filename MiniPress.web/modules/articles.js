import {apiMiniPress} from "./config.js";

const getDataArticles = async () => {
  try {
    let resp = await fetch(`${apiMiniPress}articles`);
    if (resp.ok) {
      return await resp.json();
    }
  } catch (err) {
    console.log(err);
  }
}

const getDataArticlesSortDateDesc = async () => {
  try {
    let resp = await fetch(`${apiMiniPress}articles?sort=date-desc`);
    if (resp.ok) {
      return await resp.json();
    }
  } catch (err) {
    console.log(err);
  }
}

const getDataArticlesSortDateAsc = async () => {
  try {
    let resp = await fetch(`${apiMiniPress}articles?sort=date-asc`);
    if (resp.ok) {
      return await resp.json();
    }
  } catch (err) {
    console.log(err);
  }
}

const getDataArticlesBycat_id = async (id) => {
  const data = getDataArticles(); 

  return data.then(data => {
    const promises = data.articles.map(element => {
      return fetch(element.url.self.href)
      .then(response => response.json())
      .then(articleDetail => {
        if(articleDetail.article.cat_id == id){
          return articleDetail.article;
        }
      });
    });

    return Promise.all(promises).then(articlesList => {
      return articlesList.filter(article => article != undefined);
    });
  });
}


const getArticleDetail = async (articleId) => {
  try {
    let resp = await fetch(`${apiMiniPress}articles/${articleId}`);
    if (resp.ok) {
      return await resp.json();
    }
  } catch (err) {
    console.log(err);
  }
} 


const getDataArticlesByAuteur = async (auteur) => {
  const data = getDataArticles();

  return data.then(data => {
    const articlesFiltre = data.articles.filter(article => article.auteur === auteur);
    return articlesFiltre;
  });
}

export default {
    getDataArticles: getDataArticles,
    getDataArticlesBycat_id: getDataArticlesBycat_id,
    getArticleDetail: getArticleDetail,
    getDataArticlesByAuteur: getDataArticlesByAuteur,
    getDataArticlesSortDateDesc: getDataArticlesSortDateDesc,
    getDataArticlesSortDateAsc : getDataArticlesSortDateAsc
}