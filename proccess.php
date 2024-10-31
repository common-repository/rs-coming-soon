<div class="wrap">
	
	<h2>Your Subscribers</h2>

	<div id="poststuff">
	
		<div id="post-body" class="metabox-holder columns-2">
		
			<!-- main content -->
			<div id="post-body-content">
				
			<form method="post" action="?page=<?php echo esc_js(esc_html($_GET['page'])); ?>">
            <input name="rscs_remove" value="1" type="hidden" />
            			<?php 

            		if (current_user_can( 'manage_options' ) ){

						if ($_SERVER['REQUEST_METHOD']=="POST" and $_POST['rscs_remove']) {
							if ($_GET['rem']) $_POST['rem'][] = $_GET['rem'];
							$count = 0;
							if (is_array($_POST['rem'])) {
								foreach ($_POST['rem'] as $id) { 
									$wpdb->query("delete from ".$wpdb->prefix."rscs where id = '".$wpdb->escape($id)."' limit 1"); 
									$count++; 
								}
								$message = $count." subscribers have been removed successfully.";
							}
						}

					}
						
					?>
	
						<table cellspacing="0" class="wp-list-table widefat fixed subscribers">
                          <thead>
                            <tr>
                                <th style="" class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"></th>
                                <th style="" class="manage-column column-name" id="name" scope="col"><span class="sorting-indicator"></span></th>
                                <th style="" class="manage-column column-email" id="email" scope="col"><span>Email Address</span><span class="sorting-indicator"></span></th>
                            </thead>
                        
                            <tfoot>
                            <tr>
                                <th style="" class="manage-column column-cb check-column" scope="col"><input type="checkbox"></th>
                                <th style="" class="manage-column column-name" scope="col"><span></span><span class="sorting-indicator"></span></th>
                                <th style="" class="manage-column column-email" scope="col"><span>Email Address</span><span class="sorting-indicator"></span></th>
                            </tfoot>
                        
                            <tbody id="the-list">
                            
                            <?php 
                            
                            if (current_user_can( 'manage_options' ) ){

								$results = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."rscs");
								if (count($results)<1) echo '<tr class="no-items"><td colspan="3" class="colspanchange">No mailing list subscribers have been added.</td></tr>';
								else {
									foreach($results as $row) {
	
										echo '<tr>
													<th class="check-column" style="padding:5px 0 2px 0"><input type="checkbox" name="rem[]" value="'.esc_js(esc_html($row->id)).'"></th>
  													<td>'.esc_js(esc_html($row->rscs_email)).'</td>
											  </tr>';
											  
											  
											  
	
									}
								}
							}
							?>
                            
                                
                            </tbody>
                        </table>
                        <br class="clear">
						<input class="button" name="submit" type="submit" value="Remove Selected" />
				</form>


         
                
			</div> 
			
			

            </div>
            <br class="clear">
	</div>
	
</div> 