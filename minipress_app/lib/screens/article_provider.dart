import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:minipress_app/models/Article.dart';
import 'package:http/http.dart' as http;

class ArticleProvider extends ChangeNotifier {
  List<Article> _articles = <Article>[];

  Future<List<Article>> getArticles() {
    if (_articles.isNotEmpty) {
      return Future<List<Article>>.value(_articles);
    }
    return fetchArticles();
  }
}

Future<List<Article>> fetchArticles() async {
  final response = await http.get(
      Uri.parse('http://docketu.iutnc.univ-lorraine.fr:45005/api/articles'));

  if (response.statusCode == 200) {
    final jsonBody = json.decode(response.body);
    final articles =
        List<Article>.from(jsonBody.map((x) => Article.fromJson(x)));
    return articles;
  } else {
    throw Exception('Failed to fetch articles');
  }
}