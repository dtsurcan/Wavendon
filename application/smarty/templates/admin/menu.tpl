
        <div class="top_menu">
          <table style="border:0px dotted">
              <td>
                <a href="{$base_url}admin/user/index/page/1"  class="{if $admin_link eq 'user'}current_admin_menu{else}admin_menu{/if}"  >Peoples</a>
              </td>
              <td>
               <a href="{$base_url}admin/feature/index/page/1" class="{if $admin_link eq 'feature'}current_admin_menu{else}admin_menu{/if}" >Features</a>
              </td>
              <td>
                <a href="{$base_url}admin/property/index/page/1"  class="{if $admin_link eq 'property' or $admin_link eq 'room' or $admin_link eq 'tenant_edit' }current_admin_menu{else}admin_menu{/if}"  >Properties</a>
              </td>
              <td>
                <a href="{$base_url}admin/block/index/page/1"  class="{if $admin_link eq 'block'}current_admin_menu{else}admin_menu{/if}"  >Blocks</a>
              </td>
            </tr>
          </table>
        </div>
