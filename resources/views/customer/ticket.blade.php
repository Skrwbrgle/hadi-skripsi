<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link
            href="https://fonts.googleapis.com/css?family=Cabin|Indie+Flower|Inknut+Antiqua|Lora|Ravi+Prakash"
            rel="stylesheet"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        />

        <style>
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }
            body {
                background: #ddd;
                font-family: "Inknut Antiqua", serif;
                font-family: "Ravi Prakash", cursive;
                font-family: "Lora", serif;
                font-family: "Indie Flower", cursive;
                font-family: "Cabin", sans-serif;
            }
            div.container {
                max-width: 1350px;
                margin: 0 auto;
                overflow: hidden;
            }
            .upcomming {
                font-size: 45px;
                text-transform: uppercase;
                border-left: 14px solid rgba(255, 235, 59, 0.78);
                padding-left: 12px;
                margin: 18px 8px;
            }
            .container .item {
                width: 1000px;
                float: center;
                padding: 0 20px;
                background: #fff;
                overflow: hidden;
                margin: 10px;
                border: 1px solid #999;
                border-radius: 18px;
            }
            .container .item-right,
            .container .pass,
            .container .item-left {
                float: left;
                padding: 20px;
            }
            .container .item-right {
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 20px;
                width: 95px;
                position: relative;
            }
            .container .item-right .up-border,
            .container .item-right .down-border {
                padding: 14px 15px;
                background-color: #646464;
                border-radius: 50%;
                position: absolute;
            }
            .container .item-right .up-border {
                top: -8px;
                right: -35px;
            }
            .container .item-right .down-border {
                bottom: -13px;
                right: -35px;
            }
            .container .item-right .num {
                font-size: 46px;
                text-align: center;
                color: #111;
                margin-bottom: -5;
            }
            .container .item-right .price {
                font-size: 16px;
                margin-top: -20px;
                text-align: center;
                color: #888;
            }
            .container .item-right .day,
            .container .item-left .event {
                color: #555;
                font-size: 14px;
                margin-top: -9px;
            }
            .container .item-right .day {
                text-align: center;
                font-size: 16px;
            }
            .container .item-left {
                /* margin-top: 9px; */
                width: 400px;
                padding: 30px 0px 46px 46px;
                border-left: 3px dotted #999;
            }
            .container .item-left .title {
                color: #111;
                font-size: 22px;
                margin-bottom: -6px;
            }
            .container .item-left .sce {
                display: block;
            }
            .container .item-left .sce .icon,
            .container .item-left .sce p,
            .container .item-left .loc .icon,
            .container .item-left .loc p {
                float: left;
                word-spacing: 5px;
                letter-spacing: 1px;
                color: #888;
                margin-bottom: -10px;
            }
            .container .item-left .sce .icon,
            .container .item-left .loc .icon {
                margin-right: 10px;
                font-size: 20px;
                color: #666;
            }
            .container .item-left .loc {
                display: block;
            }
            .fix {
                clear: both;
            }

            .container .item-left .footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                font-size: 20px;
                letter-spacing: 4px;
                text-align: center;
                color: #555;
                margin-top: 30px;
                margin-bottom: -30px;
            }
            .container .pass {
                display: block;
                /* padding-top: 60px; */
                align-items: center;
                justify-content: center;
                text-align: center;
                color: #555;
                padding: 60px 0px 0px 0px;
                /* border-left: 3px solid #999; */
            }
            .container .pass .jum {
                padding-bottom: -20px;
                color: #111
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="item">
                <div class="item-right">
                    <div>
                        <h2 class="num">{{ $data['tgl_berangkat'] }}</h2>
                        <p class="day">{{ $data['bulan_berangkat'] }}</p>
                        <p class="price">{{ $data['price'] }}</p>
                    </div>
                    <span class="up-border"></span>
                    <span class="down-border"></span>
                </div>
                <div class="item-left">
                    <p class="event">Travelize - {{ $data['nama_travel'] }}</p>
                    <h2 class="title">{{ $data['rute'] }}</h2>
                    <div class="sce">
                        <div class="icon">
                            <i class="fa fa-table"></i>
                        </div>
                        <p>{{ $data['hari_berangkat'] }}</p>
                    </div>
                    <div class="fix"></div>
                    <div class="loc">
                        <div class="icon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <p>{{ $data['titik_jemput'] }}</p>
                    </div>
                    <div class="fix"></div>
                    <div class="footer">
                        {{ $data['id_order'] }}
                        <button class="tickets">Ticket</button>
                    </div>
                </div>
                <div class="pass">
                    <h1 class="jum">{{ $data['penumpang'] }}</h1>
                    <p>Orang</p>
                </div>
            </div>
        </div>
    </body>
</html>
