# Projet Art et Culture 🎨🎭

Ce projet vise à promouvoir l'art et la culture à travers une plateforme où les utilisateurs peuvent publier des articles sur des sujets variés tels que la peinture, la musique, la littérature, le cinéma, et plus encore. La plateforme permet aux utilisateurs de découvrir du contenu culturel enrichissant, tout en offrant aux auteurs un espace pour partager leurs articles.

## Fonctionnalités 🚀

### En tant qu'administrateur :
- 🗂️ **Gestion des catégories** : Créer, modifier et supprimer des catégories pour structurer les articles publiés.
- 👥 **Gestion des utilisateurs** : Consulter les profils des utilisateurs et s'assurer qu'ils respectent les règles de la plateforme.
- 📑 **Gestion des articles** : Consulter et approuver ou refuser les articles soumis par les utilisateurs.

### En tant qu'utilisateur :
- ✍️ **Inscription et connexion** : Inscription avec votre nom, email et mot de passe. Connexion sécurisée pour accéder aux fonctionnalités adaptées.
- 🔍 **Navigation et affichage du contenu** : Explorez les articles par catégorie, découvrez du contenu culturel intéressant.
- 🆕 **Affichage des derniers articles** : Voir les derniers articles sur la page d'accueil et filtrer par catégorie avec pagination.

### En tant qu'auteur :
- 📝 **Création d'articles** : Créer, modifier et supprimer des articles en les associant à une catégorie spécifique.
- 🔄 **Modification et gestion des articles** : Maintenir la qualité et la pertinence des articles.

## Technologies 💻

- **PHP 8** avec **Programmation Orientée Objet** (OOP)
- **PDO** pour interagir avec la base de données
- **MySQL** pour la gestion de la base de données
- **HTML**, **CSS**, et **JavaScript** pour l'interface utilisateur

## 🎯 Critères de Performance

### 1. **Planification des Tâches sur Jira**
   - **Objectif** : Utilisation d'un outil de gestion des tâches, tel que Jira, pour planifier, organiser et suivre l'avancement des tâches du projet.
   - **Détails** : Chaque fonctionnalité sera définie comme une *User Story*, permettant de diviser le travail en étapes claires. L’objectif est de suivre l’évolution du projet et s'assurer qu'aucune tâche n’est négligée.
   - **Exemple d'User Story** : "En tant qu'administrateur, je veux pouvoir créer une catégorie d'article pour organiser les contenus."

### 2. **Commits Journaliers sur GitHub**
   - **Objectif** : Réalisation de commits journaliers pour assurer la traçabilité et faciliter la gestion des versions du projet.
   - **Détails** : Chaque commit documente un changement majeur ou mineur dans le code, facilitant le suivi des modifications et la résolution des conflits de code.
   - **Pratique recommandée** : Effectuer des commits clairs et descriptifs, par exemple :
     ```bash
     git commit -m "Ajout de la fonctionnalité de création de catégorie"
     ```

### 3. **Adaptabilité à Différents Écrans (Responsive Design)**
   - **Objectif** : S’assurer que le site soit accessible et bien affiché sur tous les types d'appareils (ordinateurs, tablettes, smartphones).
   - **Détails** : Utilisation de **Tailwind CSS** ou d’un autre framework CSS pour appliquer un design responsive, garantissant une expérience utilisateur optimale sur tous les écrans.
   - **Mise en œuvre** : Utilisation des classes utilitaires de Tailwind comme `sm:`, `md:`, `lg:`, et `xl:` pour ajuster les éléments en fonction des tailles d'écran.

### 4. **Validation des Formulaires**
   - **Validation Frontale (Côté Client)** :
     - **Objectif** : Minimiser les erreurs d'entrée avant même que le formulaire ne soit soumis.
     - **Détails** : Utilisation des attributs HTML5 (par exemple, `required`, `minlength`, `pattern`) et de JavaScript pour valider les données côté client, garantissant que l'utilisateur fournit les bonnes informations dès le début.
     - **Exemple** : 
       ```html
       <input type="email" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" />
       ```

   - **Validation Backend (Côté Serveur)** :
     - **Objectif** : S'assurer que les données soumises par l'utilisateur soient valides et sûres.
     - **Détails** : La validation côté serveur est nécessaire pour se protéger contre les attaques malveillantes telles que le Cross-Site Scripting (XSS) et le Cross-Site Request Forgery (CSRF).
     - **Pratique recommandée** : Utilisation de bibliothèques PHP sécurisées et de mécanismes comme `filter_var()` pour valider les entrées.

### 5. **Sécurité**

   - **Prévention des Injections SQL** :
     - **Objectif** : Éviter les attaques par injection SQL qui pourraient compromettre la base de données.
     - **Détails** : Utilisation de requêtes préparées avec PDO pour interagir avec la base de données, ce qui empêche l'injection de code malveillant.
     - **Exemple** :
       ```php
       $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
       $stmt->execute(['email' => $email]);
       ```

   - **Prévention du Cross-Site Scripting (XSS)** :
     - **Objectif** : Éviter l'injection de scripts malveillants dans les pages web, qui pourraient compromettre la sécurité des utilisateurs.
     - **Détails** : Appliquer un échappement approprié des données avant de les afficher dans les pages HTML. Utiliser des fonctions comme `htmlspecialchars()` pour sécuriser les données.
     - **Exemple** :
       ```php
       echo htmlspecialchars($userInput, ENT_QUOTES, 'UTF-8');
       ```

   - **Page 404** :
     - **Objectif** : Créer une page d'erreur 404 personnalisée pour informer les utilisateurs lorsqu'ils accèdent à une page inexistante.
     - **Détails** : Une page 404 bien conçue informe l'utilisateur du problème et lui permet de retourner facilement à la page d'accueil ou de naviguer ailleurs.
     - **Exemple de message** :
       ```html
       <h1>Page introuvable</h1>
       <p>Désolé, la page que vous recherchez n'existe pas.</p>
       <a href="/">Retour à la page d'accueil</a>
       ```

### 6. **Structure du Projet**
   - **Critère** : La logique métier doit être clairement séparée de l'architecture pour garantir une gestion facile du projet.
   - **Détails** : Utilisation de la **Programmation Orientée Objet (POO)** pour structurer le code en classes, avec des contrôleurs et des modèles distincts pour une meilleure organisation du projet.

---

## 🚀 Conclusion

Ces critères de performance garantissent non seulement la qualité technique du projet mais aussi une expérience utilisateur fluide et sécurisée. En suivant ces directives, vous assurez la robustesse, la sécurité et la scalabilité de votre plateforme.


