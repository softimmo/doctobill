
<article class="markdown-body entry-content" itemprop="text">
<p align="center">
<h1> Doctobill : Rdv par internet  </h1>
</article>
<p>
Ce projet <a href="https://symfony.com">symfony</a> fournit une application simple de rendez-vous.
</p>
<h2>L'application se compose en 2 Parties :</h2>
<ul>
    <li>Le back-end (connexion privé) définit les rendez-vous possibles</li>
    <li>Le front-end permet aux clients de prendre rendez-vous sur les plages disponibles définis par le back-end</li>
</ul>

<h2>Pour une installation locale :</h2>
<ul>
    <li>Cloner le projet par un git clone ou par download</li>
    <li>Créer la base de donnée et executer le script de création des tables fournit à la racine du projet</li>
    <li>Modifier le fichier app\config\parameter.yml pour personnaliser vos propriétés de base de données et les adresses email de reception</li>
    <li>Si necessaire : Dans une console Faire un  <a href="https://symfony.com/blog/upgrading-your-symfony-projects-the-easy-way">composer update</a> pour disposer des dernières versions des bundles symfony</li>
</ul>

<h2>Le projet est livré avec 2 utilisateurs</h2>
<ul>
  <li>Admnistrateur : admin/admin     
  <br>Permet de gérer l'ensemble du site : sociétés, utilisateurs,calendrier, spécialité ou localisation etc... 
  </li>
  <li>Gestionnaire : gestion1/gestion1     
  <br>Permet de gérer la société associé : utilisateurs, calendrier, spécialité ou localisation  etc...
  </li> 
</ul>


