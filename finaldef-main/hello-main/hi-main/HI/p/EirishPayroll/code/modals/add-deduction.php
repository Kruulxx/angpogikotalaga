<!-- add deduction modal -->
<div class="modal fade" id="deductionModal" tabhome="-1" aria-labelledby="deductionModalLabel" aria-hidden="true">
    <form method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deductionModalLabel">Add Deduction</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <label for="emp-name">Employee Name</label>
                    <select name="emp-name" id="" class="form-select">

                        <option value="" selected required>--Choose Employee--</option>
                        <?php
                        $select_employee = mysqli_query($GLOBALS['con'], "SELECT * FROM employee");
                        while ($row = mysqli_fetch_assoc($select_employee)) {
                        ?>
                            <option value="<?= $row['emp_id'] ?>"><?= $row['name'] ?></option>

                        <?php } ?>
                    </select>
                    <label for="deduction">Cash Advance</label>
                    <input type="number" name="deduction" id="" class="form-control mb-2" required>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    <button name="add" type="submit" class="btn btn-outline-success">Add</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- edit deduction modal -->
<div class="modal fade" id="caDeduction<?= $id ?>" tabhome="-1" aria-labelledby="caDeductionModalLabel" aria-hidden="true">
    <form method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="caDeductionModalLabel">Cash Advance Deduction</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="id" value="<?= $id ?>">

                    <label for="ca-deduction">Cash Advance Deduction</label>
                    <?php
                    $select_query = mysqli_query($GLOBALS['con'], "SELECT ca_deduction FROM cash_advance WHERE emp_id = '$id'");
                    while ($rows = mysqli_fetch_assoc($select_query)) {
                        $value = $rows['ca_deduction'];
                    };
                    ?>

                    <input type="text" name="ca-deduction" id="" class="form-control mb-2" value="<?= $value ?>" required>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    <button name="edit" type="submit" class="btn btn-outline-success">Deduction</button>
                </div>
            </div>
        </div>
    </form>
</div>