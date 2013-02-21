<div id="main">
    <h3>History</h3>
    <table>
        <tr>
            <th>ID:</th>
            <th>From (date):</th>
            <th>To (date):</th>
            <th>Room:</th>
            <th>Landlord:</th>
            <th>Weekly Rate:</th>
        </tr>
        ~~foreach from=$history item=i~
        <tr>
            <td>~~$i.id~</td>
            <td>~~$i.from_date~</td>
            <td>~~$i.to_date~</td>
            <td><a class="blue" href="index.php?action=room&id=~~$i.ROOMID~">~~$i.name~</a></td>
            <td><a class="blue" href="index.php?action=users&category=landlords&id=~~$i.landlord_id~">~~$i.first_name~ ~~$i.middle_name~ ~~$i.last_name~</a></td>
            <td><strong>&pound;~~$i.weekly_rate~</strong></td>
        <tr>
        ~~/foreach~
    </table>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<script type="text/javascript">
</script>