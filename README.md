# doctobill

<article class="markdown-body entry-content" itemprop="text">
<p align="center">
Doctobill : Rdv par internet
</article>

Ce projet <a href="https://symfony.com">symfony</a> fournit une application simple de rendez-vous.
<h2>L'application se compose en 2 Parties :
<ul>
    <li>Le back-end (connexion privé) définit les rendez-vous possibles</li>
    <li>Le front-end permet aux clients de prendre rendez-vous sur les plages disponibles définis par le back-end</li>
</ul>

<br/>Pour une installation locale :
<ul>
    <li>Cloner le projet par un git clone ou par download</li>
    <li>Créer la base de donnée et executer le script de création des tables</li>
    <li>Modifier le fichier app\config\parameter.yml pour personnaliser les propriétés de la base de données et les adresses email de recption</li>
    <li>Le login admin est par defaut adim/admin</li>
    <li>Si necessaire : Dans une console Faire un  <a href="https://symfony.com/blog/upgrading-your-symfony-projects-the-easy-way">composer update</a> pour disposer des dernières versions des bundles symfony</li>
</ul>
