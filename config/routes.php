<?php

return array(
    
    'films/([0-9]+)' => 'film/view/$1',	// Показывает выбранный фильм
    
    'catalog' => 'catalog/index',	// Переходит в каталог всех кинопроизведений
    'genre/([0-9]+)/page-([0-9]+)' => 'catalog/genre/$1/$2',
    'genre/([0-9]+)' => 'catalog/genre/$1',	// Показывает фильмы выбраннго жанра
    'year/([0-9]+)/page-([0-9]+)' => 'catalog/year/$1/$2',
    'year/([0-9]+)' => 'catalog/year/$1',	//Показывает фильмы выбранного года

    'movies/([0-9]+)' => 'catalog/movie/$1',	//Показывает только фильмы
    'series/([0-9]+)' => 'catalog/series/$1',	//Показывает только сериалы
    'anime/([0-9]+)' => 'catalog/anime/$1',	//Показывает только аниме

    'movies/genre/([0-9]+)' => 'catalog/genreMovie/$1',	//Показывает только фильмы указанного жанра
    'series/genre/([0-9]+)' => 'catalog/genreSeries/$1',	//Показывает только сериалы указанного жанра
    'anime/genre/([0-9]+)' => 'catalog/genreAnime/$1',	//Показывает только аниме указанного жанра

    'movies/year/([0-9]+)' => 'catalog/yearMovie/$1',	//Показывает только фильмы указанного года
    'series/year/([0-9]+)' => 'catalog/yearSeries/$1',	//Показывает только сериалы указанного года
    'anime/year/([0-9]+)' => 'catalog/yearAnime/$1',	//Показывает только аниме указанного года

    'User/login' => 'user/login',
    'User/logout' => 'user/logout',
    'User/([0-9]+)' => 'cabinet/index/$1',
    'User/register' => 'user/register',
    'User/edit' => 'cabinet/edit',

    'Starlight.Cinema' =>'cinema/index',
    'Starlight.Cinema/show_list' => 'cinema/list',
    'Starlight.Cinema/day/([A-Z]+)' => 'cinema/',
    'Starlight.Cinema/About' => 'cinema/about',
    'Starlight.Cinema/Contacts' => 'cinema/contacts',

    'administrator/films/addgenres' => 'administrator/addgenre',
    'administrator/films/removegenres' => 'administrator/removegenre',
/*Пути для работы с фильмами*/
    'administrator/films' => 'administrator/films',
    'administrator/add/film' => 'administrator/createfilm',
    'administrator/create/film' => 'admin_creates/film',
    'administrator/edit/film/([0-9]+)' => 'administrator/editfilm/$1',
    'administrator/update/film/([0-9]+)' => 'admin_updates/film/$1',
    'administrator/remove/film/([0-9]+)' => 'admin_remove/film/$1',
    'administrator/change/film_status/([0-9]+)'=> 'admin_updates/status/$1',
/*Пути для для работы с жанрами*/
    'administrator/genres' =>'administrator/genres',
    'administrator/add/genre' =>'administrator/creategenre',
    'administrator/create/genre' =>'admin_creates/genre',
    'administrator/edit/Genre/([0-9]+)' =>'administrator/editgenre/$1',
    'administrator/update/Genre/([0-9]+)' =>'admin_updates/genre/$1',
    'administrator/remove/Genre/([0-9]+)' =>'admin_remove/genre/$1',
/*Пути для для работы с годами*/
    'administrator/years' =>'administrator/years',
    'administrator/add/year' =>'administrator/createyear',
    'administrator/create/year' =>'admin_creates/year',
    'administrator/remove/Year/([0-9]+)' =>'admin_remove/year/$1',
/*Пути для для работы с сеансами*/
    'administrator/seanses' =>'administrator/seanses',
    'administrator/add/seanse' =>'administrator/createseanse',
    'administrator/s_set' => 'seanses/getsomelist',
    'administrator/create/seanse' =>'admin_creates/seanse',
    'administrator/edit/seanse' =>'administrator/editseanse',
    'administrator/update/seanse' =>'admin_updates/seanse',
    'administrator/remove/seanse/([0-9]+)' =>'admin_remove/seanse/$1',
/*Пути для для работы с пользователями*/
    'administrator/users' =>'administrator/users',
    'administrator/add/user' =>'administrator/createuser',
    'administrator/create/user' =>'admin_creates/user',
    'administrator/edit/user/([0-9]+)' =>'administrator/edituser/$1',
    'administrator/update/user/([0-9]+)' =>'admin_updates/user/$1',
    'administrator/remove/user/([0-9]+)' =>'admin_remove/user/$1',
/*Основные страницы*/
    'about' => 'start_page/about',
    'contacts' => 'start_page/contacts',
    '' => 'start_page/index', // Переходит на главную страницу
    
);
