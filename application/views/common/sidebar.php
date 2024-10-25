<aside class="main-sidebar sidebar-dark-primary">
    <?php $this->load->view('common/logo'); ?>
    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a id="menu_home" href="Javascript:void(0);" class="nav-link menu-close-click"
                       onclick="Home.listview.listPage();">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <!--                <li class="nav-item">
                                    <a id="menu_industry_profile" href="Javascript:void(0);" class="nav-link menu-close-click"
                                       onclick="IndustryProfile.listview.listPage();">
                                        <i class="nav-icon fas fa-building"></i>
                                        <p>Company Profile</p>
                                    </a>
                                </li>-->
                <li class="nav-item">
                    <a id="menu_dept_services" href="Javascript:void(0);" class="nav-link menu-close-click"
                       onclick="Home.listview.listPageForDeptServices();">
                        <i class="nav-icon fas fa-landmark"></i>
                        <p>Departments & Services</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a id="menu_business" href="Javascript:void(0)" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Manage Business <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a id="menu_zed" href="Javascript:void(0);"
                               onclick="Business.listview.listPage();" class="nav-link menu-close-click">
                                <i class="fas fa-briefcase nav-icon"></i>
                                <p>Manage ZED</p>
                            </a>
                        </li>
                        <?php if (get_from_session('temp_id_for_eodbsws') == 44) { ?>
                            <li class="nav-item">
                                <a id="menu_pan" href="Javascript:void(0);"
                                   onclick="Business.listview.listPageForPAN();" class="nav-link menu-close-click">
                                    <i class="fas fa-id-card nav-icon"></i>
                                    <p>Manage PAN</p>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a id="menu_oph" href="Javascript:void(0);" class="nav-link menu-close-click"
                       onclick="Home.listview.listPageForOPH();">
                        <i class="nav-icon fas fa-rupee-sign"></i>
                        <p>Online Payment History</p>
                    </a>
                </li>
                <!--                <li class="nav-item has-treeview">
                                    <a id="menu_weightandmeasure" href="Javascript:void(0)" class="nav-link">
                                        <i class="nav-icon fas fa-list-alt"></i>
                                        <p>Weights & Measures <i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a id="wmregistration" href="Javascript:void(0);"
                                               onclick="Wmregistration.listview.listPage();" class="nav-link menu-close-click">
                                                <i class="fas fa-id-card nav-icon"></i>
                                                <p>New Registration W & M</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="repairer" href="Javascript:void(0);"
                                               onclick="Repairer.listview.listPage();" class="nav-link menu-close-click">
                                                <i class="fas fa-id-card nav-icon"></i>
                                                <p>License for Repairer</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="repairer_renewal" href="Javascript:void(0);"
                                               onclick="RepairerRenewal.listview.listPage();" class="nav-link menu-close-click">
                                                <i class="fas fa-id-card nav-icon"></i>
                                                <p>Lice. for Repairer - Renewal</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="dealer" href="Javascript:void(0);"
                                               onclick="Dealer.listview.listPage();" class="nav-link menu-close-click">
                                                <i class="fas fa-id-card nav-icon"></i>
                                                <p>License for Dealer</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="dealer_renewal" href="Javascript:void(0);"
                                               onclick="DealerRenewal.listview.listPage();" class="nav-link menu-close-click">
                                                <i class="fas fa-id-card nav-icon"></i>
                                                <p>Lice. for Dealer - Renewal</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="manufacturer" href="Javascript:void(0);"
                                               onclick="Manufacturer.listview.listPage();" class="nav-link menu-close-click">
                                                <i class="fas fa-id-card nav-icon"></i>
                                                <p>License for Manufacturer</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="manufacturer_renewal" href="Javascript:void(0);"
                                               onclick="ManufacturerRenewal.listview.listPage();" class="nav-link menu-close-click">
                                                <i class="fas fa-id-card nav-icon"></i>
                                                <p>Lice. for Manuf. - Renewal</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a id="menu_pwd" href="Javascript:void(0)" class="nav-link">
                                        <i class="nav-icon fas fa-list-alt"></i>
                                        <p>P. W. D<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a id="wc" href="Javascript:void(0);"
                                               onclick="WC.listview.listPage();" class="nav-link menu-close-click">
                                                <i class="fas fa-id-card nav-icon"></i>
                                                <p>New Water Connection</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a id="menu_tourism" href="Javascript:void(0)" class="nav-link">
                                        <i class="nav-icon fas fa-list-alt"></i>
                                        <p>TOURISM<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a id="hotelregi" href="Javascript:void(0);"
                                               onclick="Hotelregi.listview.listPage();" class="nav-link menu-close-click">
                                                <i class="fas fa-id-card nav-icon"></i>
                                                <p>Hotel Registration Form</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a id="travelagent" href="Javascript:void(0);"
                                               onclick="TravelAgent.listview.listPage();" class="nav-link menu-close-click">
                                                <i class="fas fa-id-card nav-icon"></i>
                                                <p>Travel Agent Registration Form</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a id="menu_psfregistration" href="Javascript:void(0)" class="nav-link">
                                        <i class="nav-icon fas fa-list-alt"></i>
                                        <p>CRSR<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a id="psfregistration" href="Javascript:void(0);"
                                               onclick="Psfregistration.listview.listPage();" class="nav-link menu-close-click">
                                                <i class="fas fa-id-card nav-icon"></i>
                                                <p>Partnership Firms Regist</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a id="menu_collectorate" href="Javascript:void(0)" class="nav-link">
                                        <i class="nav-icon fas fa-list-alt"></i>
                                        <p>COLLECTORATE<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a id="cinema" href="Javascript:void(0);"
                                               onclick="Cinema.listview.listPage();" class="nav-link menu-close-click">
                                                <i class="nav-icon fas fa-film"></i>
                                                <p>Cinema Form</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a id="menu_dic" href="Javascript:void(0)" class="nav-link">
                                        <i class="nav-icon fas fa-list-alt"></i>
                                        <p>DIC<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a id="textile" href="Javascript:void(0);"
                                               onclick="Textile.listview.listPage();" class="nav-link menu-close-click">
                                                <i class="nav-icon fas fa-industry"></i>
                                                <p>For TEXTILE Sectors</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a id="msme" href="Javascript:void(0);"
                                               onclick="MSME.listview.listPage();" class="nav-link menu-close-click">
                                                <i class="nav-icon fas fa-industry"></i>
                                                <p>For MSME</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a id="menu_dic_dnh" href="Javascript:void(0)" class="nav-link">
                                        <i class="nav-icon fas fa-list-alt"></i>
                                        <p>DIC DNH<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a id="noc" href="Javascript:void(0);"
                                               onclick="Noc.listview.listPage();" class="nav-link menu-close-click">
                                                <i class="nav-icon fas fa-industry"></i>
                                                <p>NOC of Lease</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a id="subletting_lessee" href="Javascript:void(0);" class="nav-link">
                                                <i class="nav-icon fas fa-list-alt"></i>
                                                <p>Sale/Transfer of Lease<i class="right fas fa-angle-left"></i></p>
                                            </a>
                
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a id="seller" href="Javascript:void(0);"
                                                       onclick="Seller.listview.listPage();" class="nav-link menu-close-click">
                                                        <i class="nav-icon fas fa-industry"></i>
                                                        <p>Seller Of Lease</p>
                                                    </a>
                                                </li>
                                            </ul>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a id="transfer" href="Javascript:void(0);"
                                                       onclick="Transfer.listview.listPage();" class="nav-link menu-close-click">
                                                        <i class="nav-icon fas fa-industry"></i>
                                                        <p>Buyer Of Lease</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a id="subletting_lessee" href="Javascript:void(0);" class="nav-link">
                                                <i class="nav-icon fas fa-industry"></i>
                                                <p>Sub-letting <i class="right fas fa-angle-left"></i></p>
                                            </a>
                
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a id="subletting" href="Javascript:void(0);"
                                                       onclick="Subletting.listview.listPage();" class="nav-link menu-close-click">
                                                        <i class="nav-icon fas fa-industry"></i>
                                                        <p>Lessee</p>
                                                    </a>
                                                </li>
                                            </ul>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a id="sublessee" href="Javascript:void(0);"
                                                       onclick="Sublessee.listview.listPage();" class="nav-link menu-close-click">
                                                        <i class="nav-icon fas fa-industry"></i>
                                                        <p>Sub-Lessee</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>-->
                <li class="nav-item">
                    <a id="menu_change_pin" href="Javascript:void(0);"
                       onclick="Home.listview.listPageForPinChange();" class="nav-link menu-close-click">
                        <i class="nav-icon fas fa-key"></i>
                        <p>Change Pin</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="menu_logout" href="<?php echo base_url() ?>login/logout" class="nav-link menu-close-click" onclick="activeLink('menu_logout');">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>