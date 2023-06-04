<div class="Contact">
    <div class="Contact__control">
        <div class="Control__display">
            <label for="Order">Trier par :</label>
            <select name="Order" id="Order">
                <option value="ASC">ordre croissant</option>
                <option value="DESC">ordre décroissant</option>
            </select>
        </div>
        <div class="Control__display">
            <label for="Filter">Filtrer par :</label>
            <select name="Filter" id="Filter">
                <option value="IDOP">Id opération</option>
                <option value="IDCLT">Id client</option>
                <option value="IDCPTE">Id compte</option>
                <option value="LIBELLEOP">Type d'opération</option>
                <option value="MONTANTOP">Montant</option>
                <option value="DATEOP">Date transaction</option>
            </select>
        </div>
        <div class="Control__display">
            <input type="text" id="Input__search" name="Input__search" placeholder="rechercher">
        </div>
        <div class="Control__display Count__fetch">

        </div>
    </div>

    <div class="RecentOrders">
        <table>
            <thead>
                <tr>
                    <td>Id opération</td>
                    <td>Id client</td>
                    <td>Id compte</td>
                    <td>Type d'opération</td>
                    <td>Montant</td>
                    <td>Date transaction</td>
                </tr>
            </thead>

            <tbody>

            </tbody>
        </table>
    </div>
</div>