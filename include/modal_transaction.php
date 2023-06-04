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
                <option value="ID_TRANS">Id transaction</option>
                <option value="IDCLT">Id client</option>
                <option value="MONTANT">Montant</option>
                <option value="DATE_TRANS">Date transaction</option>
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
                    <td>Id transaction</td>
                    <td>Id client</td>
                    <td>Compte départ</td>
                    <td>Compte Arrivé</td>
                    <td>Montant</td>
                    <td>Date transaction</td>
                </tr>
            </thead>

            <tbody>

            </tbody>
        </table>
    </div>
</div>