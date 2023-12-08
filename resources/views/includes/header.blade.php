@if(config('app.type') == 'demo')
<div class="banner-root" data-name="HmLpoZiE">
    <style>
        .headerstrip {
          height: 50px;
          position: relative;
          font-family: -apple-system, BlinkMacSystemFont, “Segoe UI”, Roboto, Oxygen-Sans, Ubuntu, Cantarell, “Helvetica Neue”,sans-serif;
          font-size: 14px;
        }
        .headerstrip .headerstrip-content-background {
            background-color: #fff;
            opacity: 1;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #f9a650;
            background: -webkit-linear-gradient(left, #f9a650, #d47819);
            background: linear-gradient(to right, #f9a650, #d47819);
            background-repeat: repeat-x;
        }
        .headerstrip .headerstrip-canvas {
          height: 50px;
          margin: auto auto;
        }
        .headerstrip .headerstrip-content {
          display: flex;
          align-items: center;
          justify-content: center;
          background-size: contain;
          background-repeat: no-repeat;
          background-size: 1000px 50px;
          width: 100%;
          height: 50px;
          max-width: 1408px;
          padding-left: 16px;
          padding-right: 16px;
          margin: 0 auto;
        }
        .headerstrip .headerstrip-text {
          color: white;
          text-decoration: none;
          padding-right: 24px;
          font-weight: 200;
          letter-spacing: 0.8px;
          position: relative;
          font-size: 16px;
          font-weight: 400;
        }
        .headerstrip .headerstrip-text strong {
          font-weight: 600;
        }
        .headerstrip .headerstrip-cta:hover {
            color: #000;
        }
        .headerstrip .headerstrip-cta-container {
          display: flex;
        }
        .headerstrip .headerstrip-cta {
          position: relative;
          background-color: #FFFFFF;
          padding: 5px 30px;
          color: #f9a650;
          font-weight: 600;
          border-radius: 4px;
          text-decoration: none;
          display: block;
          text-align: center;
          min-width: 100px;
        }
        .headerstrip .headerstrip-cta-mobile {
          color: #FFFFFF;
          text-decoration: underline;
          padding-left: 5px;
        }
        .headerstrip .headerstrip-cta-mobile:hover {
          color: #FFFFFF;
        }
        .headerstrip .headerstrip__banner-dismiss {
          width: 12px;
          background: none;
          border: none;
          padding: 0;
          font: inherit;
          cursor: pointer;
          outline: inherit;
          margin-left: 24px;
          opacity: 0.4;
          color: white;
          text-decoration: none;
          -webkit-transition: all 100ms ease;
          -moz-transition: all 100ms ease;
          -o-transition: all 100ms ease;
          transition: all 100ms ease;
        }
        .headerstrip .headerstrip__banner-dismiss:hover {
          -webkit-transform: scale(1.3);
          transform: scale(1.3);
        }
        .headerstrip .is-hidden-desktop .headerstrip-content {
          text-align: center;
        }
        .headerstrip .is-hidden-desktop .headerstrip-text {
          position: relative;
          padding-right: 24px;
        }
        .headerstrip .is-hidden-desktop .headerstrip__banner-dismiss {
          margin-left: 0;
        }
        .headerstrip .headerstrip__dismiss-icon {
          width: 12px;
          height: 12px;
          fill: #FFFFFF;
          display: inline-block;
        }
        .page-header.navbar .top-menu .navbar-nav>li.dropdown.dropdown-notification ul.dropdown-menu.dropdown-menu-default {
            /*max-height: 250px !important;
            overflow-y: auto !important;*/
        }
        @media (max-width: 1024px) {
          .headerstrip .is-hidden-tablet-and-below {
            display: none !important;
          }
        }
        @media (min-width: 1025px) {
          .headerstrip .is-hidden-desktop {
            display: none !important
          }
        }
    </style>
    <div class="banner-container" data-name="eQfvEABi">
        <div class="headerstrip" data-name="wbSFCROM">
            <div class="headerstrip-content-background" data-name="IaTCIccC"></div>
            <div class="headerstrip-canvas is-hidden-desktop" data-name="cLiekfdj">
                <div class="headerstrip-content" data-name="wYGQXOpO">
                  <div class="headerstrip-text" data-name="uHSHBzpw">
                    {{trans('app.header.demo_version')}}
                    <a class="js-banner__link headerstrip-cta-mobile" href="https://www.mumara.com/campaigns/pricing/" target="_blank">
                        {{trans('app.header.buy_now')}}
                    </a>
                  </div>
                </div>
            </div>
            <div class="headerstrip-canvas is-hidden-tablet-and-below" data-name="OjAGEyBQ">
                <div class="headerstrip-content" data-name="bqwmfEST">
                  <div class="headerstrip-text" data-name="gMMfDvQj">{{trans('app.header.demo_version')}}</div>
                  <a class="js-banner__link headerstrip-cta" href="https://www.mumara.com/campaigns/pricing/" target="_blank">
                      {{trans('app.header.buy_now')}}
                  </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<style type="text/css">
    .ctime.versNew {
        display: inline-block;
        width: auto;
        height: 50px;
        overflow: hidden;
    }
    .ctime.versNew a {
        color: #c6cfda;
        line-height: 50px;
        text-decoration: none;
    }
    .ctime.versNew a .versnum {
        border-radius: 4px;
        border: 1px solid #c6cfda;
        padding: 0px 15px;
        margin-left: 10px;
        font-size: 16px;
    }
    .ctime.versNew a:hover {
        color: #fff;
    }
    .ctime.versNew a:hover .versnum {
        color: #2b3643;
        background: #fff;
        border-color: #a4aebb;
    }
    .lvers {
        display: inline-block;
        position: relative;
        float: right;
        margin: 0;
        padding: 0;
        width: auto;
        height: 50px;
        line-height: 50px;
        padding-right: 25px;
        color: #c6cfda;
        font-size: 13px;
    }
    .lvers .btn-warning {
        padding: 2px 12px;
        margin-left: 10px;
        border: 1px solid #fff;
        margin-top: -4px !important;
        background-color: #D4A052;
    }
    .lvers span {
        padding: 1px 10px;
        margin-left: 2px;
        border: 1px solid #fff;
        margin-right: 2px;
        color: #fff;
        background-color: #D4A052;
        font-size: 15px;
        border-radius: 4px;
    }
    .portlet>.portlet-title>.caption {
        font-size: 16px;
    }
    input[type=checkbox], input[type=radio] {
        width: 16px;
        height: 16px;
        vertical-align: bottom;
    }
    .page-footer-inner.copyrights {
        float: right;
    }
    @media (max-width: 767px) {
        .page-header.navbar .top-menu .navbar-nav>li.dropdown-notification .dropdown-menu {
            margin-right: 0 !important;
        }
        .page-header.navbar .top-menu .navbar-nav>li.dropdown-notification .dropdown-menu:after, .page-header.navbar .top-menu .navbar-nav>li.dropdown-notification .dropdown-menu:before {
            margin-right: 5px !important;
        }
        .m-heading-1.m-bordered {
            margin-bottom: 15px;
        }
        .ctime div p a {
            margin-left: 0 !important;
            font-size: 10px !important;
        }
        .page-header.navbar .page-logo {
            width: 150px;
        }
        .page-header.navbar .page-logo img.logo-default {
            width: 100%;
            height: auto;
            margin-top: 7px !important;
        }
    }
    .page-header.navbar.headerMain {
        background: #006262;
        min-height: 20px !important;
        height: auto;
    }
    .close {
        top: 12px !important;
        width: 12px;
        height: 12px;
        text-indent: inherit;
        outline: 0;
        font-size: 0;
        color: #000;
        font-weight: 100;
    }
    .topMessage {
        margin: 0px;
        padding: 15px;
        text-align: center;
        font-size: 16px;
    }
    .page-header.navbar.headerMain .topMessage div {
        display: inline-block;
    }
    .page-header.navbar.headerMain .topMessage div:hover a button {
        color: #000;
        text-decoration: none !important;
    }

    .page-header.navbar.headerMain .topMessage div a button {
        margin-top: 0 !important;
        margin-left: 20px;
        position: relative;
        background-color: #FFFFFF;
        padding: 4px 24px;
        color: #006262;
        font-weight: 600;
        border-radius: 4px;
        text-decoration: none !important;
        display: block;
        text-align: center;
        min-width: 100px;
    }
    .page-header.navbar .top-menu .navbar-nav>li.dropdown .dropdown-menu {
        box-shadow: 0 0 0 rgba(0,0,0,0) !important;
        min-width: 325px;
    }
    li.viewAll {
        position: absolute;
        width: 100%;
        bottom: 0;
        left: 0;
        right: 0;
    }
    li.viewAll a.btn {
        padding: 3px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 0 !important;
        border: 0;
        border-top: 1px solid #ececec;
    }
    ul.dropdown-menu.profile {
        min-width: 160px !important;
        width: 160px !important;
    }
    ul.dropdown-menu.profile li a {
        font-weight: 400 !important;
        padding: 14px 16px 14px;
        border-bottom: 1px solid #e7eaf0;
    }
    ul.dropdown-menu.profile li:last-child a {
        border-bottom: 0;
    }
    #header_notification_bar ul.dropdown-menu li.external a.btn.btn-xs.btn-default.btn-rounded.pull-right {
        width: auto !important;
        padding: 1px 6px !important;
        margin-right: 0;
        color: #333 !important;
        float: right;
        border-radius: 3px !important;
    }
    .page-header.navbar .top-menu .navbar-nav>li.dropdown-extended .dropdown-menu .dropdown-menu-list>li>a>.message {
        display: block;
        font-size: 13px;
        font-weight: 400;
        color: #888;
    }
    .page-header.navbar .top-menu .navbar-nav>li.dropdown-extended .dropdown-menu .dropdown-menu-list>li>a>.subject>span.from {
        color: #2ab4c0;
        font-size: 13px;
        font-weight: 600;
    }
    .page-header.navbar .top-menu .navbar-nav>li.dropdown-extended .dropdown-menu .dropdown-menu-list>li:hover>a {
        color: #888 !important;
    }
    .page-header.navbar .top-menu .navbar-nav>li.dropdown-extended .dropdown-menu .dropdown-menu-list>li>a {
        padding: 16px 15px 18px !important;
        height: auto;
        text-decoration: none;
    }  
    .page-header.navbar .top-menu .navbar-nav>li.dropdown-notification .dropdown-menu .dropdown-menu-list>li a .time {
        max-width: 150px;
        color: #000;
        opacity: .5;
        font-size: 12px;
        font-weight: 400;
        padding: 0;
        background: transparent;
    }
    #header_notification_bar ul.dropdown-menu li.viewAll {
        display: block;
        border-top: 1px solid #eff2f6;
    }
    #header_notification_bar ul.dropdown-menu li.viewAll:hover a.btn {
        color: #333 !important;
    }
    #header_notification_bar ul.dropdown-menu li.viewAll a.btn {
        width: 100%;
        border: 0;
        color: #337ab7 !important;
        font-size: 12px;
        font-weight: 600;
        padding: 6px 10px !important;
    }
    span.subject {
        position: relative;
        clear: both;
        float: left;
        width: 100%;
    }
    .page-header.navbar .top-menu .navbar-nav>li.dropdown-notification .dropdown-menu .dropdown-menu-list>li>a:hover .time {
        background: #ffffff00;
    }
    .page-header.navbar .top-menu .navbar-nav>li.dropdown-extended .dropdown-menu>li.external>a {
        color: #337ab7 !important;
        font-weight: 400;
    }
    .page-header.navbar .top-menu .navbar-nav>li.dropdown-extended .dropdown-menu>li.external>a:hover {
        color: #23527c !important;
        text-decoration: none;
    }
    @media(max-width: 767px) {
        .page-header.navbar .top-menu .navbar-nav>li.dropdown .dropdown-menu {
            min-width: 285px;
        }
    }

    ul.dropdown-menu-list.scroller {
        padding-bottom: 30px;
    }
    .icon-bell:before {
        content: "\e027" !important;
    }
    .icon-close:before {
        content: "\e082" !important;
    }
    .page-quick-sidebar-wrapper .page-quick-sidebar {
        background: #fff;
    }
    .page-quick-sidebar-wrapper {
        background: #fff;
        width: 425px;
        right: -425px;
        max-width: 100%;
        z-index: 99999;
    }
    .page-quick-sidebar-open .page-quick-sidebar-toggler {
        z-index: 100000;
    }
    .page-quick-sidebar-wrapper .page-quick-sidebar .page-quick-sidebar-list {
        width: 425px!important;
        max-width: 100%;
    }
    .page-quick-sidebar-wrapper .page-quick-sidebar .page-quick-sidebar-item {
        width: 425px!important;
        margin-left: 425px;
        max-width: 100%;
    }
    .page-quick-sidebar-wrapper .page-quick-sidebar .nav-tabs>li.active>a, .page-quick-sidebar-wrapper .page-quick-sidebar .nav-tabs>li:hover>a {
        border-bottom: 3px solid #36c6d3;
        color: #36c6d3;
        text-transform: capitalize;
    }
    .page-quick-sidebar-wrapper .page-quick-sidebar .nav-tabs>li {
        display: inline-block !important;
        width: auto !important;
        padding: 0px;
        float: left;
    }
    .page-quick-sidebar-wrapper .page-quick-sidebar .nav-tabs:after {
        content: '';
        border-bottom: 3px solid rgba(93, 120, 255, 0.1);
        width: 100%;
        bottom: 3px;
        position: relative;
        z-index: 0;
    }
    .page-quick-sidebar-wrapper .page-quick-sidebar .nav-tabs>li>a {
        text-transform: capitalize;
        border-bottom: 3px solid transparent;
        z-index: 99;
        padding: 45px 20px 8px;
    }
    .feeds li .col1>.cont {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        padding: 0;
        -webkit-transition: background-color 0.3s ease;
        transition: background-color 0.3s ease;
    }
    .feeds li .col1>.cont>.cont-col1 {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-flex: 0;
        -ms-flex: 0 0 2.5rem;
        flex: 0;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        margin: 0;
        float: none;
    }
    .feeds li .col1, .feeds li .col1>.cont>.cont-col2 {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
    }
    .feeds li .col1>.cont>.cont-col2>.desc {
        -webkit-transition: color 0.3s ease;
        transition: color 0.3s ease;
        font-size: 13px;
        font-weight: 400;
        color: #6c7293;
        font-family: Poppins;
        line-height: 1.5;
        margin: 0;
        margin-left: 15px;
    }
    .feeds li .col1>.cont>.cont-col2>.desc .date {
        font-size: 13px;
        font-weight: 300;
        color: #a7abc3;
        font-family: Poppins;
    }
    .page-quick-sidebar-wrapper .page-quick-sidebar .list-items>li {
        border-bottom-color: #eee;
    }
    .page-quick-sidebar-wrapper .page-quick-sidebar .list-items>li:hover {
        background: #f7f8fa;
    }
    ul.feeds.list-items.scroller {
        height: 100vh !important;
    }
    .page-quick-sidebar-wrapper .page-quick-sidebar .page-quick-sidebar-list .page-quick-sidebar-chat-users {
        position: relative;
        padding: 10px 0;
    }
    .page-quick-sidebar-wrapper .page-quick-sidebar .nav-tabs>li>a {
        font-weight: 400;
        letter-spacing: 0.5px;
        font-family: Poppins;
        font-size: 0.8rem;
    }
    div#quick_sidebar_tab_3 .bootstrap-switch {
        zoom: 0.8;
        border-radius: 20px;
        border: 1px solid #f1f1f1;
    }
    .page-quick-sidebar-wrapper .page-quick-sidebar .feeds li .col1>.cont>.cont-col1>.label {
        display: inline-block;
        padding: 0;
        vertical-align: middle;
        background-color: transparent;
        color: #36c6d3;
        text-align: center;
        width: 25px;
        height: 25px;
        line-height: 25px;
    }
    .page-quick-sidebar-wrapper .page-quick-sidebar .feeds li .col1>.cont>.cont-col1>.label>i {
        line-height: 1 !important;
        font-size: 18px;
    }
    .page-quick-sidebar-wrapper .page-quick-sidebar .list-items>li.unread {
        background: #f3f5f9;
        border-bottom-color: #dfe2e9;
        cursor: pointer;
    }
    #m-read {
        width: 100%;
        z-index: 99;
        cursor: pointer;
        background: #fff;
        border: 0;
        padding: 0;
        text-align: right;
        padding-right: 10px;
        font-size: 13px;
        color: #36c6d3;
        margin-bottom: 5px;
        margin-top: -7px;
    }
    #m-read:hover {
        text-decoration: underline;
    }
    .page-quick-sidebar-toggler>i {
        cursor: pointer;
    }
    .sidebar-setup-guide h2 {
        font-weight: 500;
        font-size: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #ddd;
        margin-bottom: 10px;
        font-family: Poppins;
    }
    .sidebar-setup-guide h4 {
        font-size: 13px;
        line-height: 1.4;
        font-weight: 400;
        color: #666;
        margin-top: 0;
        font-family: Poppins;
    }
    .setepOptions h3 {
        font-weight: 600;
        color: #666;
        margin: 0;
        cursor: pointer;
        font-family: Poppins;
        font-size: 15px;
    }
    .setepOptions.done {
        background: #f9f9f9;
        border: 1px solid #f3f3f3;
    }
    .setepOptions {
        padding: 20px;
        /*border: 1px dashed #ddd;*/
        margin-bottom: 15px;
        background: #f3f3f3;
        position: relative;
    }
    .setepOptions p {
        color: #666;
        font-size: 13px;
        display: none;
        margin-bottom: 0;
    }
    .setepOptions p span {
        position: relative;
        float: none;
        display: block;
        font-family: Poppins;
        color: #888;
        font-size: 12px;
        font-weight: 300;
    }
    .setepOptions .setupico {
        position: absolute;
        right: 20px !important;
        left: auto;
        top: 20px;
        width: 100%;
        text-align: right;
    }
    .setepOptions .setupico i {
        font-size: 18px;
        color: #333;
        cursor: pointer;
        width: 100%;
    }
    input.optcheckbox {
        margin: 0;
        vertical-align: middle;
    }
    #quick_sidebar_tab_2 .page-quick-sidebar-setup-users {
        display: block;
        width: 100%;
        height: 100vh;
        overflow: hidden;
        overflow-y: overlay;
        padding-bottom: 70px;
    }
    #quick_sidebar_tab_2 .scroller {
        padding: 0 15px;
        overflow: visible;
    }
    #quick_sidebar_tab_2 .slimScrollDiv {
        overflow: visible !important;
        width: 100%;
    }
    .setepOptions button {
        margin-right: 10px;
        margin-top: 10px;
    }
    .page-quick-sidebar-toggler {
        position: absolute;
        z-index: 1;
        right: 1.5rem;
        top: 1.5rem;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        width: 28px;
        height: 28px;
        background-color: #f7f8fa;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
        border-radius: 4px;
        text-align: center;
        padding:0;
    }
    .page-quick-sidebar-open .page-header .top-menu .dropdown-quick-sidebar-toggler>.dropdown-toggle i:before, .page-quick-sidebar-open .page-quick-sidebar-toggler>i:before {
        content: "\f00d";
    }
    .page-quick-sidebar-toggler>i {
        cursor: pointer;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
        font-size: 0.8rem;
        color: #a7abc3;
        vertical-align: sub;
        margin-top: 7px;
    }
    .page-quick-sidebar-toggler:hover {
        background: #2b3643 !important;
    }
    .page-quick-sidebar-toggler:hover>i {
        color: #fff!important;
    }
    .page-quick-sidebar-toggler>i:hover {
        color: #fff!important;
    }
    .page-header.navbar .top-menu .navbar-nav>li.dropdown>.dropdown-toggle>.badge {
        font-family: "Open Sans",sans-serif;
        top: 7px;
        right: 25px;
    }
    .setepOptions i.upside {
        display: none;
    }
    .setepOptions.open i.upside {
        display: block;
    }
    .setepOptions.open i.downside {
        display: none;
    }
    .setepOptions.open p.paraSetup {
        display: block;
    }
    .setepOptions h3 i {
        margin-left: 7px;
        font-size: 16px;
        opacity: 0;
    }
    .setepOptions.done h3 i {
        opacity: 1;
    }
    .setepOptions.done p.paraSetup button {
        display: none;
    }
    .page-quick-sidebar-wrapper .page-quick-sidebar .tab-content>.tab-pane {
        margin-bottom: 0;
    }
    .page-quick-sidebar-open .page-header .top-menu .dropdown-quick-sidebar-toggler>.dropdown-toggle i:before {
        content: "\e065";
    }
    .page-quick-sidebar-wrapper .page-quick-sidebar .list-items>li:hover .desc {
        color: #36c6d3;
    }
    .page-quick-sidebar-wrapper .page-quick-sidebar .scroller {
        padding: 0;
        margin: 0;
    }
    .setepOptions.done>h3, .setepOptions.done i {
        color: #ccc;
        pointer-events: none;
    }
    .setepOptions.done h3 i {
        opacity: 1;
        color: #36c6d3;
        font-size: 22px;
    }
    .page-quick-sidebar-wrapper .page-quick-sidebar .page-quick-sidebar-settings .page-quick-sidebar-settings-list {
        padding: 15px;
    }
    .updateBlk {
        display: block;
        padding: 20px 20px;
        margin-bottom: 20px;
    }
    .updateBlk .versBlk {
        text-align: center;
        font-size: 15px;
        padding: 0;
        width: 50% !important;
        font-family: Poppins;
    }
    .updateBlk .versBlk:first-child .nBlk {
        color: #0abb87;
        border-right: 3px solid #666;
    }
    .alert-success {
        color: #056146;
        background-color: #cef1e7;
        border-color: #baecdd;
    }
    .updateBlk .versBlk:last-child .nBlk {
        color: #856012;
    }

    .updateBlk .versBlk .nBlk {
        display: block;
        -webkit-box-align: stretch;
        -ms-flex-align: stretch;
        align-items: stretch;
        padding: 0.1rem 0.5rem;
        margin: 5px 0 20px 0;
        text-align: center;
        font-size: 40px;
        line-height: 1.4;
        font-weight: 600;
    }
    .alert-warning {
        color: #856012;
        background-color: #fff7e4;
        border-color: #ffebc1;
    }
    .updateBlk .versBlk .nBlk small {
        font-size: 12.6px;
        display: block;
        padding: 10px 0 0;
        font-weight: 500;
    }
    .updateBlk .versBlk .nBlk small:last-child {
        padding-top: 0;
        padding-bottom: 5px;
    }
    .updateBlk .updateBtn {
        text-align: center;
        margin-bottom: 15px;
    }
    .changes-logs h3 {
        font-family: Poppins;
        font-size: 15px;
    }
    .changes-logs .kt-list-timeline__items {
        font-family: Poppins;
        margin-top: 14px;
        position: relative;
        margin: 20px 0 15px !important;
    }
    .kt-list-timeline .kt-list-timeline__items .kt-list-timeline__item .kt-list-timeline__text {
        display: table-cell;
        text-align: left;
        vertical-align: middle;
        width: 100%;
        padding: 0 0 0 5px;
        color: #6c7293;
        font-size: 13px;
        font-weight: 400;
        margin: 20px 0 15px;
    }
    .kt-list-timeline .kt-list-timeline__items::before {
        background-color: #e2e4e8;
        position: absolute;
        display: block;
        content: '';
        width: 1px;
        height: 100%;
        top: 0;
        bottom: 0;
        left: 3px;
    }
    .kt-list-timeline .kt-list-timeline__items .kt-list-timeline__item:first-child {
        padding-top: 0;
        margin-top: 0;
    }
    .kt-list-timeline .kt-list-timeline__items .kt-list-timeline__item {
        position: relative;
        display: table;
        table-layout: fixed;
        width: 100%;
        padding: 0.3rem 0;
            padding-top: 0.3rem;
        margin: 0.5rem 0;
            margin-top: 0.5rem;
    }
    .kt-list-timeline .kt-list-timeline__items .kt-list-timeline__item .kt-list-timeline__badge {
        text-align: left;
        vertical-align: middle;
        display: table-cell;
        position: relative;
        width: 20px;
    }
    .kt-list-timeline .kt-list-timeline__items .kt-list-timeline__item:first-child::before, .kt-list-timeline .kt-list-timeline__items .kt-list-timeline__item:last-child::before {
        background-color:  #e2e4e8;
    }
    .kt-list-timeline .kt-list-timeline__items .kt-list-timeline__item:first-child::before, .kt-list-timeline .kt-list-timeline__items .kt-list-timeline__item:last-child::before {
        background-color:  #e2e4e8;
        position: absolute;
        display: block;
        content: '';
        width: 1px;
        height: 50%;
        top: 0;
        bottom: 0;
        left: 3px;
    }
    
    .kt-list-timeline .kt-list-timeline__items .kt-list-timeline__item .kt-list-timeline__badge::before {
        background-color: #e2e4e8;
        position: absolute;
        display: block;
        content: '';
        width: 7px;
        height: 7px;
        left: 0;
        top: 50%;
        margin-top: -3.5px;
        border-radius: 100%;
    }
    .kt-list-timeline .kt-list-timeline__items .kt-list-timeline__item .kt-list-timeline__badge.kt-list-timeline__badge--success::before {
        background-color: #0abb87;
    }
    .kt-list-timeline .kt-list-timeline__items .kt-list-timeline__item .kt-list-timeline__badge.kt-list-timeline__badge--primary::before {
        background-color: #5867dd;
    }
    .kt-list-timeline .kt-list-timeline__items .kt-list-timeline__item .kt-list-timeline__badge.kt-list-timeline__badge--warning::before {
        background-color: #ffb822;
    }
    .kt-list-timeline .kt-list-timeline__items .kt-list-timeline__item .kt-list-timeline__badge.kt-list-timeline__badge--danger::before {
        background-color: #fd397a;
    }
    .kt-list-timeline__title {
        font-weight: 600;
        font-size: 1.1rem;
        padding-left: 25px;
        margin-bottom: 10px;
        color: #646c9a;
    }
    .kt-list-timeline .kt-list-timeline__items {
        position: relative;
        padding: 0;
        margin: 0;
    }
    .kt-separator.kt-separator--space-lg {
        margin: 2rem 0;
    }
    .kt-separator.kt-separator--border-dashed {
        border-bottom: 1px dashed #ebedf2;
    }
    .kt-separator {
        height: 0;
        margin: 20px 0;
        border-bottom: 1px solid #ebedf2;
    }
    div#logsAll button.close {
        top: 15px !important;
    }
    div#logsAll .modal-body {
        padding: 15px !important;
    }


    .updateBlk>img.updateImg {
        position: relative;
        float: none;
        display: block;
        margin: 25px auto;
        max-width: 120px;
        width: 100%;
    }
    .page-quick-sidebar-open .page-quick-sidebar-wrapper {
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        right: 0;
    }
    .page-quick-sidebar-wrapper {
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        -webkit-box-shadow: 0px 1px 9px -3px rgba(0, 0, 0, 0.75);
        box-shadow: 0px 1px 9px -3px rgba(0, 0, 0, 0.55);
    }
    .feeds li .col1>.cont {
        margin-right: 0px;
    }
    .feeds li .col1>.cont>.cont-col2>.desc {
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        width: 92%;
    }
    .page-header.navbar .top-menu .navbar-nav>li.dropdown a i.fa.fa-circle:before {
        content: "\f111";
    }
    .page-header.navbar .top-menu .navbar-nav>li.dropdown a i.fa.fa-circle {
        position: absolute;
        font-size: 3px;
        margin-left: 6px;
        margin-top: 5px;

    }
    a.trash-records {
        padding: 4px 15px !important;
        border-bottom: 1px solid #ddd;
        border-top: 1px solid #ddd;
        /*text-align: right;*/
        font-size: 12px;
        color: #f9526d !important;
        font-weight: 400!important;
    }
</style>

<script>
    function changeImportStatus(list_id) {

        $.ajax({
            url: "{{ url('/') }}"+'/list/import/status/change/'+list_id,
            type: 'GET',
            success: function (data) {
                if(data == 'success') {
                    // window.location.href = "{{ url('/') }}"+"/list/" + list_id + "/contacts";
                } else {
                    alert("{{trans('app.header.list_not_found')}}");
                }
            }
        }); 
    }

    function clearAllImports() {
        $.ajax({
            url: "{{ url('/') }}"+'/list/import/clear/all',
            type: 'GET',
            success: function (data) {
                if(data == 'success') {
                    window.location.href = "{{ url('/') }}";
                } else {
                    alert("{{trans('app.header.list_not_found')}}");
                }
            }
        });
    }
</script>

{{--
@if(isset($version))
<div class="page-header navbar headerMain" id="headerMain" data-name="ooIThimP">
    <button type="button" class="close" id="hnotfy" data-dismiss="modal" aria-hidden="true">×</button>
    <div class="col-md-12 font-grey" data-name="VcpfaOTm">
        <div class="topMessage" data-name="TIRFAMpW">
            <i class="icon-info"></i> {{trans('app.header.new_update_available')}} 
            <div class="" data-name="pqEctiRc">
                <a href="{{ route('setting.update.index') }}"><button type="button" class="btn btn-default">{{trans('app.header.update_now')}}</button></a>
            </div>
        </div>
    </div>
</div>
@endif
--}}

<div class="page-header navbar" data-name="rNSfncIY">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner" data-name="bDnTqloF">
        <!-- BEGIN LOGO -->
        <div class="page-logo" data-name="OHXwuAZc">
                <a href="{{ route('dashboard') }}"><img src="/assets/images/logo.png" alt="logo" class="logo-default" height="40" /></a>
            <div class="menu-toggler sidebar-toggler" data-name="hyoiThNZ">
                <span></span>
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <div class="ctime" data-name="IZfvBQad">
            <div id="" data-name="vMfEvSrV"><p><a href="#modal-bug-report" data-toggle="modal" class="btn btn-success btn-xs"> {{trans('common.header.report_a_bug')}}</a></p></div>
        </div> 
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>

        
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        @if(isset($timezone))
        <?php 
             $time_zone_user_data = DB::table('users')->where('id', Auth::user()->id)->value('timezone');
             if(empty($time_zone_user_data)) $time_zone_user_data = "UTC";
             $local_tz = new DateTimeZone($time_zone_user_data);
             $local = new DateTime('now', $local_tz);
         
             //NY is 3 hours ahead, so it is 2am, 02:00
             $user_tz = new DateTimeZone('UTC');
             $user = new DateTime('now', $user_tz);
             
             $local_offset = $local->getOffset();
             $user_offset = $user->getOffset();
         
              $diff = $local_offset - $user_offset  ;
              $hours = floor($diff / 3600);
              $minutes = floor(($diff / 60) % 60);
        ?>
        <div style="display: none;" data-name="ZFEqgBKa">
            <span id="server-time-hour">{{isset($hours) ? $hours : ''}}</span>
            <span id="server-time-minutes">{{isset($minutes) ? $minutes : ''}}</span>
        </div>
        @endif
        <div class="top-menu" data-name="kBsgRPjK">
            <div class="ctime" data-name="CUcmGRCn">
                <div class="clock" data-name="KZXzWGDB">
                <div id="header_time" data-name="dJbovbXq"></div>
                </div>
            </div>
            
            <ul class="nav navbar-nav pull-right">

                @php
                    $count_imports = \App\Lists::where('import_status', 1)->count();
                    $lists_import = \App\Lists::where('import_status', 1)->get();
                @endphp
                @if($count_imports >= 1)
                <li class="dropdown dropdown-extended dropdown-notification">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" title="Lists Successfully Imported">
                        <i class="icon-arrow-down"></i>
                        <span class="badge badge-default">{{ $count_imports }}</span>
                        
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        @foreach($lists_import as $list)
                        <li>
                            <a href="" onClick="changeImportStatus({{ $list->id }})">
                                <i class="icon-notebook"></i> {{ $list->name }}  
                                @if($list->import_status == 1)
                                    <span class="badge">{{trans('app.header.new')}}</span>
                                @endif
                            </a>
                        </li>
                        @endforeach
                        <li><a href="#" onclick="clearAllImports();" class="trash-records">{{trans('sending_nodes.include_header_blade.trash_all_action')}}</a></li>
                    </ul>  

                </li>
                @endif

                @php
                    $count_lists = \App\Lists::where('export_status', 1)->count();
                    $lists = \App\Lists::where('export_status', 1)->get();
                    $count_download = \App\Lists::where('export_status', 1)
                                                ->where('download_status', 0)
                                                ->count();
                @endphp

                @if($count_lists >= 1)
                <li class="dropdown dropdown-extended dropdown-notification">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" title="download list">
                        <i class="icon-cloud-download"></i>
                        @if($count_download >= 1)
                            <span class="badge badge-default">{{ $count_download }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        
                        @foreach($lists as $list)
                        <li>    
                            <a href="{{ route('list.export.download.csv',  $list->id) }}">
                                <i class="icon-notebook"></i> {{ $list->name }} </a>
                        </li>
                        @endforeach
                    </ul>    
                </li>
                @endif

                <li class="dropdown dropdown-extended dropdown-notification">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="icon-question"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="https://help.mumara.com/hc/en-us" target="_blank">
                                <i class="icon-book-open"></i> {{trans('app.header.knowledgebase')}} </a>
                        </li>
                        <li>
                            <a href="https://community.mumara.com/" target="_blank">
                                <i class="icon-bubbles"></i> {{trans('app.header.community_support')}} </a>
                        </li>
                        <!-- <li>
                            <a href="https://billing.mumara.com/submitticket.php" target="_blank">
                                <i class="icon-envelope"></i> {{trans('app.header.headings.ticket')}} </a>
                        </li> -->
                        <li>
                            <a href="https://community.mumara.com/forum/3/feature-request/" target="_blank">
                                <i class="icon-note"></i> {{trans('app.header.feature_request')}} </a>
                        </li>
                        <li>
                            <a href="https://community.mumara.com/forum/4/bug-reporting/" target="_blank">
                                <i class="icon-pencil"></i> {{trans('app.dashboard.bug_report.title')}} </a>
                        </li>
                    </ul>
                </li>

                
                    <li class="dropdown dropdown-extended dropdown-notification hide" id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-bell"></i>
                            @if($notification_counter > 0)
                            <span class="badge badge-default"> {{$notification_counter}} </span>
                            @endif
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3>
                                    <span class="bold">1757 {{trans('app.header.new')}}</span> {{trans('app.header.notifications')}}
                                </h3>
                                <a href="#">{{trans('app.header.view_all')}}</a>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height:300px;" data-handle-color="#637283">
                                <li>
                                    <a href="#">
                                        <span class="subject">
                                            <span class="from"><i class="icon-arrow-up"></i> {{trans('app.header.import_list')}} </span>
                                            <span class="time"> {{trans('app.header.just_now')}} </span>
                                        </span>
                                        <span class="message">{{trans('app.header.subscribers_imported')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="subject">
                                            <span class="from"><i class="icon-cloud-download"></i> {{trans('app.header.download_list')}} </span>
                                            <span class="time"> 15 {{trans('app.header.minutes_ago')}} </span>
                                        </span>
                                        <span class="message">{{trans('app.header.demo_exported')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="subject">
                                            <span class="from"><i class="fa fa-exchange"></i> {{trans('app.header.campaign_finished')}} </span>
                                            <span class="time"> 7 {{trans('app.header.hours_ago')}} </span>
                                        </span>
                                        <span class="message">{{trans('app.header.campaign_finished_go')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="subject">
                                            <span class="from"><i class="icon-notebook"></i> {{trans('app.header.campaign_stuck')}} </span>
                                            <span class="time"> 3 {{trans('app.header.days_ago')}} </span>
                                        </span>
                                        <span class="message">{{trans('app.header.campaign_stuck_view')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="subject">
                                            <span class="from"><i class="icon-arrow-up"></i> {{trans('app.header.import_list')}} </span>
                                            <span class="time"> 15 {{trans('app.header.days_ago')}} </span>
                                        </span>
                                        <span class="message">{{trans('app.header.subscribers_imported_global')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="subject">
                                            <span class="from"><i class="icon-cloud-download"></i> {{trans('app.header.download_list')}} </span>
                                            <span class="time"> 1 {{trans('app.header.months_ago')}} </span>
                                        </span>
                                        <span class="message">{{trans('app.header.demo_exported')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="subject">
                                            <span class="from"><i class="fa fa-exchange"></i> {{trans('app.header.campaign_finished')}} </span>
                                            <span class="time"> {{trans('sending_nodes.include_header_blade.months_ago_span')}}  </span>
                                        </span>
                                        <span class="message">{{trans('app.header.campaign_finished_go')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="subject">
                                            <span class="from"><i class="icon-notebook"></i> {{trans('app.header.campaign_stuck')}} </span>
                                            <span class="time"> 1 {{trans('app.header.years_ago')}} </span>
                                        </span>
                                        <span class="message">{{trans('app.header.campaign_stuck_view')}}</span>
                                    </a>
                                </li>
                                {{-- @foreach($user_notifications as $notification)
                                    <li>
                                        <a href="{{ route('notification.show', ['id' => $notification->notification_id ]) }}">
                                            <span class="details">
                                            <span class="label label-sm label-icon label-success">
                                                    <i class="icon-bell"></i>
                                            </span>
                                            @if($notification->is_read)
                                            {{$notification->notification_title}}
                                            @else
                                            <b>{{$notification->notification_title}}</b>
                                            @endif
                                            <span class="time">{{str_replace(array("minutes", "second"), array("min", "sec"), Carbon\Carbon::parse($notification->created_at)->diffForHumans())}}</span>
                                            </span>
                                        </a>
                                    </li>
                                    @endforeach --}}
                                </ul>
                            </li>
                            <li class="viewAll">                        
                                <a href="{{ URL('logs') }}" class="btn btn-block btn-default">{{trans('app.header.view_all_notifications')}}</a>
                            </li>
                        </ul>
                    </li>
                

                <li class="dropdown dropdown-extended dropdown-notification dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <span class="username username-hide-on-mobile"> {{ isset(Auth::user()->name) ? Auth::user()->name : ''  }} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default profile">
                        <li>
                            <a href="{{ route('user.profile',isset(Auth::user()->id) ? Auth::user()->id : '') }}">
                                <i class="icon-user"></i>{{trans('app.header.profile')}} </a>
                        </li>
                        
                        <li>
                            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="icon-power"></i> {{trans('app.header.logout')}} 
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                            <input type="hidden" name="user_name" value="{{isset(Auth::user()->name) ? Auth::user()->name : ''}}">
                            <input type="hidden" name="user_id" value="{{isset(Auth::user()->id) ? Auth::user()->id : ''}}">
                            </form>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->

                <li class="dropdown dropdown-quick-sidebar-toggler" id="bellIcon">
                    <a href="javascript:;" class="dropdown-toggle">
                        @if(isset($version))
                        <i class="fa fa-circle font-red"></i>
                        <i class="icon-bell font-red"></i>
                        @else
                        <i class="icon-bell"></i>
                        @endif
                        
                        <span class="badge badge-default" id="notifCount"></span>
                    </a>
                </li>

            </ul>
        </div>
        @php /* @if(isset($license_attributes->nextduedate) && $license_attributes->nextduedate == "0000-00-00" && (isset($license_attributes->productname) && stripos($license_attributes->productname, '15-Days Trial') !== false))
        */ @endphp
        @if((isset($license_attributes->productname) && stripos($license_attributes->productname, '15-Days Trial') !== false))
            <div class="lvers" data-name="wpPHBZxP">
                <?php
                 $date  = Carbon\Carbon::parse($license_attributes->regdate)->addDays(15);
                 $now = Carbon\Carbon::now();

                 $diff = $date->diffInDays($now);
                 echo trans('app.header.trial_expires')."<span>".$diff."</span>".trans('app.header.days');
                 echo "<a href='https://billing.mumara.com/upgrade.php?type=package&id={$license_attributes->pid}' target='_blank'><button class='btn btn-warning'>".trans('app.header.upgrade')."</button></a>";
                 ?>
            </div>
        @endif
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>