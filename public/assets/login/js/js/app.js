/*!
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This file should be included in all pages
 !**/

/*
 * Global variables. If you change any of these vars, don't forget 
 * to change the values in the less files!
 */
var left_side_width = 220; //Sidebar width in pixels

$(function() {
$( "button" ).click(function() {
							 
var button_id =  this.id;

if(button_id=='pm')
{
	var id = 'pm_box';
}
if(button_id=='rm')
{
	var id = 'rm_box';
}

$( "#"+id ).slideToggle( "slow" );
});

});
