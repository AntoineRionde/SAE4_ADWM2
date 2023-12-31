import 'package:flutter/material.dart';
import 'package:minipress_app/models/categorie.dart';
import 'package:minipress_app/screens/categorie_preview.dart';
import 'package:minipress_app/screens/categorie_provider.dart';

class CategorieMaster extends StatefulWidget {
  CategorieMaster({Key? key}) : super(key: key);

  @override
  State<CategorieMaster> createState() => _CategorieMasterState();

  List<Categorie> categories = <Categorie>[];
}

class _CategorieMasterState extends State<CategorieMaster> {
  final Future<String> _calculation = Future<String>.delayed(
    const Duration(seconds: 2),
    () => 'Data Loaded',
  );

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Column(
        children: <Widget>[
          FutureBuilder<String>(
              future: _calculation,
              builder: (BuildContext context, AsyncSnapshot<String> snapshot) {
                if (snapshot.connectionState == ConnectionState.waiting) {
                  return const CircularProgressIndicator();
                } else if (snapshot.hasError) {
                  return Text('${snapshot.error}');
                } else {
                  return Container();
                }
              }),
          Expanded(
            child: FutureBuilder<List<Categorie>>(
              future: CategorieProvider().getCategories(),
              builder: (BuildContext context,
                  AsyncSnapshot<List<Categorie>> snapshot) {
                if (snapshot.hasData) {
                  widget.categories = snapshot.data!;
                  final List<CategoriePreview> categoriePreview =
                      snapshot.data!.map((categorie) {
                    return CategoriePreview(categorie: categorie);
                  }).toList();
                  return Column(
                    children: [
                      Expanded(
                        child: ListView(
                          children: categoriePreview,
                        ),
                      ),
                    ],
                  );
                } else {
                  return const Text('Chargement en cours');
                }
              },
            ),
          ),
        ],
      ),
    );
  }
}
