import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:minipress_app/models/article.dart';
import 'package:http/http.dart' as http;

class ArticleProvider extends ChangeNotifier {
  List<Article> _articles = <Article>[];

  Future<List<Article>> getArticles() async {
    if (_articles.isNotEmpty) {
      return _articles;
    }
    return await fetchArticles();
  }

  Future<List<Article>> getArticlesByTri(bool sortOrder) async {
    if (_articles.isNotEmpty) {
      return _articles;
    }
    return await fetchArticlesByTri(sortOrder);
  }

  Future<List<Article>> getArticlesByAuteur(int auteurId) async {
    if (_articles.isNotEmpty) {
      return _articles;
    }
    return await fetchArticlesByAuteur(auteurId);
  }

  Future<List<Article>> fetchArticlesByAuteur(int auteurId) async {
    final response = await http.get(Uri.parse(
        'http://docketu.iutnc.univ-lorraine.fr:45005/api/auteurs/$auteurId/articles'));
    final articles = <Article>[];

    if (response.statusCode == 200) {
      final jsonBody = json.decode(response.body);
      final jsonArticles = jsonBody['article'];
      for (int i = 0; i < jsonArticles.length - 1; i++) {
        final articleId = jsonArticles["$i"]['id'];
        final article = await ArticleProvider().fetchArticle(articleId);
        articles.add(article);
      }
      _articles = articles;
      return articles;
    } else {
      throw Exception('Failed to fetch articles');
    }
  }

  Future<List<Article>> fetchArticlesByTri(bool sortOrder) async {
    String order = sortOrder ? 'date-asc' : 'date-desc';

    final response = await http.get(Uri.parse(
        'http://docketu.iutnc.univ-lorraine.fr:45005/api/articles?sort=$order'));
    final articles = <Article>[];

    if (response.statusCode == 200) {
      final jsonBody = json.decode(response.body);
      final jsonArticles = jsonBody['articles'];
      for (var jsonArticle in jsonArticles) {
        final articleUrl = jsonArticle['url']['self']['href'];
        final articleId = int.parse(articleUrl.split('/').last);
        final article = await fetchArticle(articleId);
        articles.add(article);
      }
      _articles = articles;
      return articles;
    } else {
      throw Exception('Failed to fetch articles');
    }
  }

  Future<List<Article>> fetchArticles() async {
    final response = await http.get(
        Uri.parse('http://docketu.iutnc.univ-lorraine.fr:45005/api/articles'));
    final articles = <Article>[];

    if (response.statusCode == 200) {
      final jsonBody = json.decode(response.body);
      final jsonArticles = jsonBody['articles'];
      for (var jsonArticle in jsonArticles) {
        final articleUrl = jsonArticle['url']['self']['href'];
        final articleId = int.parse(articleUrl.split('/').last);
        final article = await fetchArticle(articleId);
        articles.add(article);
      }
      _articles = articles;
      return articles;
    } else {
      throw Exception('Failed to fetch articles');
    }
  }

  Future<Article> fetchArticle(int articleId) async {
    final response = await http.get(Uri.parse(
        'http://docketu.iutnc.univ-lorraine.fr:45005/api/articles/$articleId'));

    if (response.statusCode == 200) {
      final jsonBody = json.decode(response.body);
      final jsonArticle = jsonBody['article'];
      return Article.fromJson(jsonArticle);
    } else {
      throw Exception('Failed to fetch article');
    }
  }
}
