<?php
$xmlSchema = simplexml_load_file('testexml.xml');


printf("Container %s\n", $xmlSchema['id']);
foreach ($xmlSchema->secao as $secao)
{
	printf("Container %s\n", $secao['id']);
	foreach ($secao->container as $container)
	{
		printf("Container %s\n", $container['id']);
	}

	/*	foreach ($colecao->book as $book) {
		printf("Title: %s <br>", $book->title);
		printf("Author: %s <br>", $book->author);
		}*/
}

?>
