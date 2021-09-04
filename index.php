<?php
include './phpQuery.php';
// Общие данные
$site = 'https://www.philharmonia.spb.ru/afisha/?d=15';
$site2 = 'https://www.philharmonia.spb.ru';
$protocol = 'https:';
$html = file_get_contents($site);
// Документ phpQuery
$doc = phpQuery::newDocument($html);
// Главные новости
$newsItems = $doc->find('.afisha_list_items');
// Перебираем новости, вытаскиваем заголовки и ссылки
$news = array();
foreach ($newsItems as $newsItem) {
    // Находим нужный элемент
    $newsElem = pq($newsItem)->find('.mer_item_title');
    // Вытаскиваем атрибуты
    $title = $newsElem->text();
    $link = $newsElem->attr('href');
    // Добавляем url сайта при необходимости
    if (strpos($link, $site) === false) {
        $link = $site . $link; }
    // Сохраняем результаты в массив
    array_push($news, array(
        'title' => $title,
        'link' => $link
    ));}
// Главные статьи
$articlesItems = $doc->find('.afisha_list_item');
// Перебираем статьи, вытаскиваем картинки, заголовки, тексты и ссылки
$articles = array();
foreach ($articlesItems as $articleItem) {
    // Находим нужный элемент
    $articleElem = pq($articleItem);
    // Вытаскиваем данные
    $image = $articleElem->find('.mer_item_img')->attr('style');
    $title = $articleElem->find('.mer_item_title')->text();
    $subtext = $articleElem->find('.mer_item_sub_title')->text();
    $date_time = $articleElem->find('.afisha_li_data')->text();
    $price =  $articleElem->find('.mer_item_prices')->text();
    $link_pr =  $articleElem->find('.pts_btn')->attr('href');
    $link = $articleElem->find('.mer_item_title')->attr('href');
    $war =  $articleElem->find('.pts_btn')->text();
    $why =  $articleElem->find('.mer_item_transfer_info')->text();
    $link_war = $articleElem->find('.pts_btn')->attr('href');
   
 $nofoto = 'img/nofoto.jpg';
	$image_no = $nofoto . $image;
	//Достаем ссылку на картинку
	if ($image_no <> 'img/nofoto.jpg' ) {
		 $image_s=explode("'", $image_no);
		 $image_url = $image_s[1];
    // Добавляем протокол или url сайта при необходимости
    	if (strpos($image_url, $site2) === false) {
        $image = $site2 . $image_url;
			 }}	
		if  ($image_no === 'img/nofoto.jpg' )
		 $image = $nofoto;
    if (strpos($link, $site2) === false) {
        $link = $site2 . $link;}
      if (strpos($link_war, $site2) === false) {
        $link_war = $site2 . $link_war;}
    // Сохраняем результаты в массив
   array_push($articles, array(
        'image' => $image,
        'title' => $title,
        'subtext' => $subtext,
       'date_time' => $date_time,
        'price'=>$price,
       'link_pr' => $link_pr,
        'link' => $link,
        'war'=> $war,
        'why'=> $why,
        'link_war'=>$link_war
    ));}
include './temp.php'; 
?>
