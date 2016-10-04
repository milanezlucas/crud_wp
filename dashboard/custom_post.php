<?php
class Custom_Post
{
	public function create_cpt( $slug, $args )
	{
		$cpts[ $slug ] = $args;

	    foreach ( $cpts as $cpt => $attr ) {
	        $label = ( isset( $attr[ 'label' ] ) ) ? $attr[ 'label' ] : ucfirst( $cpt );
	        $label_plural = ( isset( $attr[ 'label_plural' ] ) ) ? $attr[ 'label_plural' ] :  $label . 's';

	        $attr[ 'labels' ] = array(
	            'name'                  => $label_plural,
	            'add_new'               => 'Adicionar',
	            'add_new_item'          => 'Adicionar ' . $label,
	            'edit_item'             => 'Editar ' . $label,
	            'new_item'              => 'Adicionar ' . $label,
	            'view_item'             => 'Visualizar ' . $label,
	            'search_items'          => 'Pesquisar ' . $label_plural,
	            'not_found'             => 'Nenhum conteúdo foi encontrado',
	            'not_found_in_trash'    => 'Nenhum conteúdo foi encontrado na lixeira',
	            'all_items'             => 'Tudo'
	        );
	        register_post_type( $cpt, $attr );
	    }
	}
}
