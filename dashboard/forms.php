<?php
class Forms
{
	protected $id;
	protected $field;
	protected $value;

	public function field( $form_id, $form_field, $form_value=null )
	{
		$this->id 			= $form_id;
		$this->value 		= $form_value ? $form_value : '';

		$this->fields_supports( $form_field );

		$form = new stdClass();
		switch ( $this->field->type ) {
			case 'text':
				$form->field = $this->text_field();
				break;
			case 'textarea':
				$form->field = $this->textarea();
				break;
			case 'select':
				$form->field = $this->select();
				break;
		}

		$form->label 	= $this->field->label;
		$form->desc 	= $this->field->desc;
		$form->name 	= $this->id;

		return $form;
	}

	// Text field
	protected function text_field()
	{
		$html .= '<input name="' . $this->id . '" id="' . $this->field->name . '" value="' . esc_attr( stripslashes( $this->value ) ) . '" class="regular-text" type="text" ' . $this->fields->required . '>';

		return $html;
	}

	// Textarea
	protected function textarea()
	{
		$html .= '
			<textarea name="' . $this->id . '" id="' . $this->fields->name . '" class="large-text" rows="3" ' . $this->fields->required . '>' . esc_attr( stripslashes( $this->value ) ) . '</textarea>
		';

		return $html;
	}


	// Select
	protected function select()
	{
		$opt_name_array = $this->field->multiple ? '[]' : '';

		$html .= '
			<select name="' . $this->id . $opt_name_array .'" id="' . $this->field->name . '" ' . $this->field->multiple . ' class="postform">
				<option value=""></option>
		';
		$values = ( is_array( $this->value ) ) ? $this->value : array( $this->value );
		if ( isset( $this->field->opt ) ) {
			foreach ( $this->field->opt as $label => $val ) {
				$html .= '<option value="' . $val . '"';
				if ( $values ) {
					$html .= ( in_array( $val, $values ) ) ? 'selected="selected"' : '';
				}
				$html .= '>' . $label . '</option>';
			}
		}
		$html .= '
			</select>
		';

		return $html;
	}

	private function fields_supports( $form_field )
	{
		$this->field = new stdClass();
		foreach ( $form_field as $prop => $value ) {
			switch ( $prop ) {
				case 'opt':
					if ( $value ) {
						$this->field->$prop = new stdClass();
						foreach ( $value as $val => $label ) {
							if ( !empty( $val ) ) {
								$this->field->$prop->$label = $val;
							}
						}
					}
					break;
				case 'required':
					$this->field->$prop = $value ? 'required="true"' : '';
					break;

				default:
					$this->field->$prop = $value;
					break;
			}
		}
	}
}
