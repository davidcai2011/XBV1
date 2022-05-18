<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js" />

<div id="invoice" >
    Invoice Page
</div>
<div id="invoice"  class="p-2 m-2 bg-white text-dark  col-md-12">


    <div   class="p-2 m-2 bg-white text-dark  col-md-5">
        <div   class="p-2 m-2 bg-white text-dark  col-md-12">
            <tr ><lable class="bg-secondary text-white fs-8">Kunden- und Rechnungsinformationen</lable></tr>
        </div>
        Kunden
    </div>
    <div id="invoice"  class="p-2 m-2 bg-white text-dark  col-md-7">


        Rechnung
    </div>
</div>

<div className="container">
    <div className="col-md-12">
        <div className="input-group mb-3">
            <input
                    type="text"
                    className="form-control"
                    placeholder="Search by customerName"
                    value={searchCustomer}
                    onChange={onChangeSearchCustomer}
            />

            <button
                    className="btn btn-outline-secondary"
                    type="button"
                    onClick={fetchCustomerList}
            >
                Search
            </button>

        </div>
    </div>
    <div className="col-md-12">
        <h4>Customers List</h4>

        <div className="row">


            {loading || !customers ? (
            <p>Loading...</p>
            ) : (

            <div className="table-responsive col-md-6">

                <div className="seven columns">

                    <CustomersTable
                            customers={customers}
                            deleteCustomer={deleteCustomer}
                            editCustomer={editCustomer}
                    />




                    )}

                </div>
                <div className="mt-3">
                    {/*{"Items per Page: "}*/}
                    {/*<select  onChange={handlePageSizeChange} value={pageSize}>*/}
                        {/*    {pageSizes.map((size) => (*/}
                        {/*        <option key={size} value={size}>*/}
                            {/*            {size}*/}
                            {/*        </option>*/}
                        {/*    ))}*/}

                        {/*</select>*/}
                    <Pagination
                            className="my-3"
                            count={pagecount}
                            page={page}
                            siblingCount={0}
                            boundaryCount={1}
                            variant="outlined"
                            shape="rounded"
                            onChange={handlePageChange}
                    />
                </div>
            </div>
            <div className="five columns">
                {editing ? (
                <div>
                    <h2>Edit customer</h2>
                    <EditCustomerForm
                            currentCustomer={currentCustomer}
                            setEditing={setEditing}
                            updateCustomer={updateCustomer}
                    />
                </div>
                ) : (
                <div>
                    <h2>Add customer</h2>
                    <AddCustomerForm addCustomer={addCustomer} />
                </div>
                )}
            </div>
        </div>


        <div class="row">
            <h5>  Rechnung bearbeiten</h5>
        </div>
        <div class="row">
            <p class="text-secondary">Kunden- und Rechnungsinformationen</p>
            <div class="table-responsive col-md-6">

                <table >

                    <tbody>
                    <tr>
                        <td class="col-md-1">Kunde *</td>
                    </tr>
                    <tr>
                        <td class="col-md-1"><input type="text" placeholder="Kontakt suchen/erstellen" style="width: 300px;"></td>
                    </tr>
                    <tr>
                        <td class="col-md-1">Anschrift</td>
                    </tr>
                    <tr>
                        <td class="col-md-1"><textarea style="width: 300px;"> </textarea></td>
                    </tr>
                    <tr>
                        <td class="col-md-1">Land *</td>
                    </tr>
                    <tr>
                        <td><select name="land" id="land" >
                                <option value="Germany">Deutschland</option>
                                <option value="Netherland">Netherland</option>
                                <option value="Frankeich">Frankeich</option>
                                <option value="Polen">Polen</option>
                            </select></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <tbody>
            <tr>
                <td class="col-md-1">Betreff *</td>
                <td class="col-md-2">Rechnungsnummer *</td>

            </tr>
            <tr>
                <td class="col-md-1"><input type="text" placeholder="Rechnung Nr. RE-1000"  style="width: 300px;"></td>
                <td class="col-md-1"><input type="text" placeholder="RE-1000"  style="width: 300px;"></td>

            </tr>
            <tr>
                <td class="col-md-1">Rechnungsdatum *</td>
                <td class="col-md-2">Zahlungsdatum </td>

            </tr>
            <tr>
                <td class="col-md-1"><input type="date" ></td>
                <td class="col-md-1"><input type="date" ></td>

            </tr>
            <tr>
                <td class="col-md-1">Lieferdatum</td>
                <td class="col-md-2">Referenz / Bestellnummer</td>
            </tr>
            <tr>
                <td class="col-md-1"><input type="date" ></td>
                <td class="col-md-1"><input type="text"  style="width: 300px;" ></td>
            </tr>
            </tbody>
            </table>
        </div>
    </div>
    <hr class="dotted">
    <div class="row">
        <p class="text-secondary">Kopf-Text</p>
    </div>

    <div className="row">


        {loading || !customers ? (
        <p>Loading...</p>
        ) : (

        <div className="table-responsive col-md-6">

            <div className="seven columns">

                <CustomersTable
                        customers={customers}
                        deleteCustomer={deleteCustomer}
                        editCustomer={editCustomer}
                />


            </div>
        </div>

                )}


    </div>