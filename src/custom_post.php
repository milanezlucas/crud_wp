<?php
define( 'CRUD_CPT_PRODUTOS', 	'produtos' );
define( 'CRUD_CPT_CLIENTES', 	'clientes' );
define( 'CRUD_CPT_PEDIDOS', 	'pedidos' );

$cpt = new Custom_Post;

$cpt->create_cpt( CRUD_CPT_PRODUTOS, array(
    'label'         => 'Produto',
    'label_plural'  => 'Produtos',
    'public'        => true,
    'show_ui'       => true,
    'has_archive'   => true,
    'rewrite'       => array( 'slug' => 'produto', 'hierarchical' => true ),
    'supports'      => array( 'title', 'excerpt' )
));

$cpt->create_cpt( CRUD_CPT_CLIENTES, array(
    'label'         => 'Cliente',
    'label_plural'  => 'Clientes',
    'public'        => true,
    'show_ui'       => true,
    'has_archive'   => true,
    'rewrite'       => array( 'slug' => 'cliente', 'hierarchical' => true ),
    'supports'      => array( 'title' )
));

$cpt->create_cpt( CRUD_CPT_PEDIDOS, array(
    'label'         => 'Pedido',
    'label_plural'  => 'Pedidos',
    'public'        => true,
    'show_ui'       => true,
    'has_archive'   => true,
    'rewrite'       => array( 'slug' => 'pedido', 'hierarchical' => true ),
    'supports'      => array( 'title' )
));

// Metaboxes
new Metabox( CRUD_CPT_PRODUTOS . '_box', CRUD_CPT_PRODUTOS, 'Informações Adicionais', array(
	'preco'	=> array(
		'type'		=> 'text',
		'label'		=> 'Preço',
		'desc'		=> 'Valor em R$',
		'required'	=> true
	)
));

new Metabox( CRUD_CPT_CLIENTES . '_box', CRUD_CPT_CLIENTES, 'Informações Adicionais', array(
	'email'	=> array(
		'type'		=> 'text',
		'label'		=> 'E-mail',
		'required'	=> true
	),
	'telefone'	=> array(
		'type'		=> 'text',
		'label'		=> 'Telefone'
	)
));

new Metabox( CRUD_CPT_PEDIDOS . '_box', CRUD_CPT_PEDIDOS, 'Informações Adicionais', array(
	'id_produto'	=> array(
		'type'		=> 'select',
		'label'		=> 'Produto',
		'required'	=> true,
		'opt'		=> crud_get_posts( CRUD_CPT_PRODUTOS )
	),
	'id_cliente'	=> array(
		'type'		=> 'select',
		'label'		=> 'Cliente',
		'required'	=> true,
		'opt'		=> crud_get_posts( CRUD_CPT_CLIENTES )
	)
));
