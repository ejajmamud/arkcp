<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Summary Report</title>

    

    <style>
        @media print {
            .download-report-link {
                display: none !important;
            }

            body {
                margin: 0;
            }

            .invoice-box {
                box-shadow: none !important;
                border: none !important;
                max-width: none !important;
                margin: 0 !important;
                padding: 0 !important;
            }
        }

        @font-face {
        font-family: 'Adobe Caslon Pro';
        src: url('http://ooisolutions.asia/fonts/ACaslonPro/ACaslonPro-Regular.woff2') format('woff2'),
            url('http://ooisolutions.asia/fonts/ACaslonPro/ACaslonPro-Regular.woff') format('woff');
        font-weight: normal;
        font-style: normal;
        font-display: swap;
    }
        body {
            font-family: Calibri;
            font-weight: 500;
            font-size: 16px;
        }

        h1, h2, h3, h4, h5 {
            color: #2d71a1;
            margin-bottom: 5px !important;
            font-family: Calibri;
        }

        h3 {
            padding: 15px 0px 5px !important;
        }

        h2 {
            margin-top: -10px;
            padding-top: 0px;
        }

        .information .user-details-rw {
            background: #0B617E;
            color: #fff;
        }

        .information .user-details-rw td {
            padding-top: 10px;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 26px;
            font-family: Calibri;
            color: #3a3a3a;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: justify;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: left;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 10px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        /* .invoice-box table tr.top table td.title img {
            float: right;
        } */
        .invoice-box table tr.information table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 0px;
            padding-left: 10px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            /*   border-top: 2px solid #eee; */
            font-weight: bold;
            color: #000;
        }

        table.user-details td {
            padding-bottom: 5px !important;
            text-align: left !important;
        }

        p.summary-code-text {
            font-size: 16px;
            font-weight: 400;
            margin-left: 5px;
            color: #2d71a1;
        }

        p.summary-code-text:first-letter {
            font-size: 28px;
            font-weight: 800;
            margin-right: 3px;
        }

        .hex-img {
            text-align: center;
        }

        .hex-img img {
            width: 600px;
            padding: 15px 0;
        }

        /* chart sytles */
        .chart-wrap {
            max-width: 400px;
            margin-top: 20px;
        }

        .chart-wrap .chart-title {
            margin-bottom: 10px;
            font-size: 16px;
            text-align: center;
            text-transform: uppercase;
        }

        .chart-wrap .row {
            position: relative;
            height: 26px;
            margin-bottom: 15px;
        }

        .chart-wrap .bar-wrap {
            position: relative;
            background: #f5f5f5;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .chart-wrap .bar-wrap .bar {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            background: #f37167;
            transition: all 1s;
            transform: translateX(-100%);
        }

        .chart-wrap .bar-wrap .bar.in {
            transform: translateX(0%);
        }

        .chart-wrap .row:nth-of-type(1) .bar {
            transition: 1s 400ms;
            background: rgb(234, 17, 132);
            background: linear-gradient(90deg, rgba(241, 87, 49, 1) 0%, rgba(234, 17, 132, 1) 100%);
        }

        .chart-wrap .row:nth-of-type(2) .bar {
            transition: 1s 600ms;
            background: rgb(24, 111, 189);
            background: linear-gradient(90deg, rgba(24, 111, 189, 1) 0%, rgba(14, 165, 231, 1) 100%);
        }

        .chart-wrap .row:nth-of-type(3) .bar {
            transition: 1s 800ms;
            background: rgb(102, 44, 142);
            background: linear-gradient(90deg, rgba(102, 44, 142, 1) 0%, rgba(185, 16, 129, 1) 100%);
        }

        .chart-wrap .row:nth-of-type(4) .bar {
            transition: 1s 1000ms;
            background: rgb(13, 176, 231);
            background: linear-gradient(90deg, rgba(13, 176, 231, 1) 0%, rgba(19, 195, 172, 1) 100%);
        }

        .chart-wrap .row:nth-of-type(5) .bar {
            transition: 1s 1200ms;
            background: rgb(157, 211, 65);
            background: linear-gradient(90deg, rgba(157, 211, 65, 1) 0%, rgba(250, 239, 64, 1) 100%);
        }

        .chart-wrap .row:nth-of-type(6) .bar {
            transition: 1s 1400ms;
            background: rgb(246, 123, 49);
            background: linear-gradient(90deg, rgba(246, 123, 49, 1) 0%, rgba(251, 196, 55, 1) 100%);
        }

        .chart-wrap .row:nth-of-type(7) .bar {
            transition: 1s 1600ms;
        }

        .bar.Artistic {
            background: rgb(234, 17, 132);
        }

        .bar.Social {
            background: rgb(24, 111, 189);
        }

        .bar.Realistic {
            background: rgb(102, 44, 142);
        }

        .bar.Conventional {
            background: rgb(13, 176, 231);
        }

        .bar.Investigative {
            background: rgb(157, 211, 65);
        }

        .bar.Enterprising {
            background: rgb(246, 123, 49);
        }

        .chart-wrap .label {
            position: absolute;
            top: 0;
            left: 0;
            width: 80px;
            padding-left: 10px;
            text-align: left;
            font-size: 12px;
            line-height: 26px;
            text-transform: uppercase;
            font-weight: bold;
            z-index: 10;
        }

        .chart-wrap .number {
            position: absolute;
            top: 0;
            right: 0;
            width: 30px;
            padding-right: 10px;
            font-size: 18px;
            line-height: 26px;
            font-weight: bold;
            text-align: right;
            z-index: 10;
        }

        @media screen and (min-width: 800px) {
            .chart-wrap .row {
                padding: 0 40px 0 90px;
            }

            .chart-wrap .label {
                text-align: right;
                padding-left: 0;
            }

            .chart-wrap .number {
                text-align: left;
                padding-right: 0;
            }
        }


        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.top table td.title img {
                float: inherit;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Calibri;
            
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }

        .inv-details td {
            padding: 0px !important;
        }

        tr.total td {
            border-top: 1px solid #111
        }

        .inv-details td {
            text-align: left !important;
            float: left;
            width: 50% !important;
        }

        .heading th {
            background: #2d71a1;
            color: #fff;
            padding: 5px 10px;
        }

        .heading2 th {
            background: #1b4a6b;
            color: #fff;
            padding: 5px 10px;
        }

        strong {
            color: #000;
        }

        .item td {
            font-size: 15px;
            padding: 10px 5px !important;
        }

        @media screen and (max-width: 600px) {
            table.itm-list {
                border: 0;
            }

            table.user-details tr td:first-child {
                display: none !important;
            }

            table.user-details tr td::before {
                width: 30% !important;
            }

            table.user-details tr {
                border: none !important;
                padding: 5px 15px 0px !important;
                margin-bottom: 0px !important;
            }

            table.itm-list caption {
                font-size: 1.3em;
            }

            table.itm-list .heading {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table.itm-list tr {
                border: 1px solid #eee;
                display: block;
                margin-bottom: .625em;
                border-radius: 5px;
                box-shadow: 0 0 3px -2px rgba(0, 0, 0, 0.2);
                padding: 10px 15px;
            }

            table.itm-list td {
                border-bottom: 1px solid #eee;
                display: block;
                font-size: .8em;
                text-align: right;
            }

            table.itm-list td::before {
                /*
                * aria-label has no advantage, it won't be read inside a table
                content: attr(aria-label);
                */
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            table.itm-list td:last-child {
                border-bottom: 0;
            }
        }

        td#summaryCode .d-flex {
            display: flex;
            align-items: flex-end;
        }

        td#summaryCode .d-flex div {
            padding: 0px 5px !important;
        }

        td#summaryCode .d-flex p {
            margin: 0px !important;
            text-align: center;
        }

        td#summaryCode .d-flex h2 {
            background: #B6E2EA;
            width: 30px;
            margin: 5px 0px !important;
            height: 30px;
            line-height: 1.5;
            text-align: center;
            font-size: 24px;
            padding: 3px 0px;
        }

        span.theme-color {
            color: #2d71a1;
        }

        ul.occu-list li {
            width: 47%;
            float: left;
            margin-right: 3%;
            
        }

        ul.occu-list {
            margin: 0px !important;
            text-align: left;
            line-height: 1.5;
        }
        .ps-info {
            display: block;
            padding-bottom: 5px;
        }
        .ps-info p {
            margin: 0px 0px 10px;
        }
        .capitalize {text-transform: capitalize !important;}
    </style>
</head>

<body>

<div class="invoice-box">
    @if(!request()->boolean('pdf_export'))
    <div class="download-report-link"
        style="background-image:url({{url('img/download-icon.png')}});float: right;background-size: 64px;width: 64px;height: 64px;padding-left: 66px;display: flex; align-items: center;background-repeat: no-repeat;">
        <a href="{{route('download.pdf', $user->id)}}" style="font-size:14px;
           line-height:20px;">
            Download Report</a>
    </div>
    @endif
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td>
                <table>
                    <tr>
                        <td>
                            <img src="{{url('img/career-preference-logo.jpg')}}"
                                 style="max-width: 250px;">
                            <h4 style="margin: 7px 0px;font-size: 18px;">www.ark.com.my</h4>
                        </td>
                    </tr>

                </table>
            </td>
            <td>
                
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>

                    <tr>
                        <td colspan="2" style="padding-bottom: 10px;"><h1>Career Preference Report</h1></td>
                    </tr>
                    <tr class="user-details-rw">
                        <td style="padding-right: 6%;">
                            <table class="user-details itm-list">
                                <tr>
                                    <td>Name</td>
                                    <td data-label="Name" class="capitalize">: <b>{{$user->firstname}} {{$user->lastname}}</b></td>
                                </tr>
                                <tr>
                                    <td>Age</td>
                                    <td data-label="Age">: <b> {{$user->age}} </b></td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td data-label="Gender" class="capitalize">: <b> {{$user->gender}} </b></td>
                                </tr>

                            </table>
                        </td>

                        <td style="padding-right: 6%;">
                            <table class="user-details itm-list">
                                <tr>
                                    <td>Group</td>
                                    <td data-label="Group" class="capitalize">: <b> {{$user->stgroup}} </b></td>
                                </tr>
                                <tr>
                                    <td>Test Date</td>
                                    <td data-label="Test Date">: <b> {{ date('d-m-Y', strtotime($user->updated_at)) }}  </b></td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td data-label="Country" class="capitalize">: <b>{{$user->country}} </b></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td>
                <h3>RIASEC Personality Type Score</h3>

                <div class="">
                    @foreach ($scores as $score)
                        <div class="row"
                             style="padding: 0 40px 0 160px; position: relative; height: 26px; margin-bottom: 15px;">
                                <span class="label"
                                      style="position: absolute; top: 0; left: 0; width: 140px; padding-left: 10px; text-align: right; font-size: 16px; line-height: 26px; text-transform: uppercase; font-weight: bold; z-index: 10; color: #0B617E;">{{$score->name}}</span>
                            <div class="bar-wrap"
                                 style="position: relative; background: #b6e2ea; width: 100%; height: 100%; overflow: hidden;">
                                <div class="bar {{$score->name}}" data-value="{{$score->value}}"
                                     style="width:{{$score->value*6.66666666667}}%;position: absolute;top: 0;left: 0;height: 100%;background: #0B617E;"></div>
                            </div>
                            <span class="number"
                                  style="position: absolute; top: 0; right: 0; width: 30px; padding-right: 10px; font-size: 18px; line-height: 26px; font-weight: bold; text-align: right; z-index: 10; text-align: center;">{{$score->value}}</span>
                        </div>
                    @endforeach
                </div>
            </td>
            <td id="summaryCode">
                <h3>Your Summary Code</h3>
                <div class="d-flex">
                    <div><p>Score</p></div>
                    @foreach ($scores as $score)
                        @if ($loop->index<3)
                            <div><h2>{{mb_substr($score->name, 0, 1)}}</h2>
                                <p>{{$score->value}}</p></div>
                        @endif
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <div>
                    <h3>Introduction</h3>
                    <p>The Career Assessment report provides you with possible career options that you can
                        explore based on their summary code (3 letters) generated above based on your test
                        results. The site also provides suggestions and resources to help you with your career
                        planning process. Every code is different and may vary in the number of career options
                        provided below.</p>
                </div>
                <div>
                    <h3>Overview of Holland’s RIASEC types</h3>
                    <p>The theory is based on extensive research about how people choose careers which
                        was first developed by Dr. John Holland in 1971. It is the most widely used interest
                        inventory in the world. It is based upon a theory that people can be loosely classified
                        into six different personality types; Realistic, Investigative, Artistic, Social,
                        Enterprising, Conventional (RIASEC).
                        The theory suggests people prefer jobs/careers where they can be around others who
                        are like them. They search for environments that will let them use their skills and
                        abilities, and express their attitudes and values, while taking on enjoyable problems
                        and roles</p>
                </div>
                <div>
                    <h3>Which type are you?</h3>
                    <p>RIASEC letters can be used to describe the personality type a person’s interest most
                        resemble. For example, if their highest code is R a person can be said he is a Realistic
                        or R type. Take note that a person often resembles several personality types not just
                        one.
                        A hexagon is used to show similarities and differences among the 6 types. Types that
                        are next to each other on the hexagon are the most similar. For example, Realistic and
                        Investigative
                        types tend to have similar interest, whereas Realistic and Social types tend to have very
                        different
                        interest.
                        Below are the characteristic and important information about the six types. Think about how it
                        relates
                        to you as you read the six types.</p>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <h3>The Personality Types</h3>
                <div class="hex-img">
                    <img src="https://ooisolutions.asia/img/report_hex.png" alt="" style="max-width: 40%;">
                </div>
                <div class="ps-info">
                        <h4>REALISTIC</h4>
                        <p>
                            Realistic people tend to have athletic interests, prefer to work with objects, machines, tools, plants or animals, and like to be outdoors.
                         </p>
                         <p> <span class="theme-color">Characteristics:</span> Independent, Practical, Systematic, Self-Controlled, and Straightforward
                          <br> <span class="theme-color">Working Environment:</span> Agriculture, Construction, Manufacturing, Distribution, Transport, Shipping and Aviation
                        </p>
                </div>
                <div class="ps-info">
                        <h4>INVESTIGATIVE </h4>
                        <p>
                            Investigative people like to observe, learn, investigate, analyze, and solve problems 
                        </p>
                         <p> <span class="theme-color">Characteristics:</span> Logical, Curious, Thoughtful, Observant, and Intellectual
                          <br> <span class="theme-color">Working Environment:</span> Academic Education, IT, Healthcare and Innovative Companies
                        </p>
                </div>
                <div class="ps-info">
                        <h4>ARTISTIC</h4>
                        <p>
                            Artistic people like to work in unstructured situations using their imagination and creativity
                         </p>
                         <p> <span class="theme-color">Characteristics:</span> Creative, Imaginative, Unconventional, Expressive, Innovative, and Impulsive
                          <br> <span class="theme-color">Working Environment:</span> Advertising, Music & Entertainment industry, Theatre, Art sector and at companies
                          in the field of creative design
                        </p>
                </div>
                <div class="ps-info">
                        <h4>SOCIAL</h4>
                        <p>
                            Social people like to work with people to inspire, inform, help, train or cure them
                         </p>
                         <p> <span class="theme-color">Characteristics:</span> Patient, Insightful, Responsible, Cooperative, Outgoing, and Skilled with words
                          <br> <span class="theme-color">Working Environment:</span> Government, Education, Health Care and Social Services.
                        </p>
                </div>
                <div class="ps-info">
                        <h4>ENTERPRISING </h4>
                        <p>
                            Enterprising people like to work with people to influence, persuade and lead them, and to achieve organizational or financial goals.
                         </p>
                         <p> <span class="theme-color">Characteristics:</span> Assertive, Energetic, Persuasive, Ambitious, Optimistic
                          <br> <span class="theme-color">Working Environment:</span> Management, Sales & Marketing, Trade, Administration and Politics
                        </p>
                </div>
                <div class="ps-info">
                        <h4>CONVENTIONAL</h4>
                        <p>
                            Conventional people like to work with information, carry out detailed tasks, and have clerical or numerical interests.
                        </p>
                         <p> <span class="theme-color">Characteristics:</span> Efficient, Well-Organized, Persistent, Methodical, or Conscientious
                          <br> <span class="theme-color">Working Environment:</span> Banking & Finance, Management & Administrative, Government
                        </p>

                    </div>
                
            </td>
        </tr>
        <tr>
                <td colspan="2">
                    <div>
                        <h3> Careers That Matches Your Personality Type</h3>
                        <p>
                            Below are the jobs for your 3 highest summary codes. The first letter of your code represents the careers most
                            suitable for your personality type. The second letter represents the next careers most suitable for your personality
                            type and so on. The types not included in the three summary codes are careers least suitable for your personality
                            type.
                           </p>
                        <p>You can print (a PDF report has also been sent to your email provided) and go through the careers listed below
                            and tick / highlight careers that you have interest in and mark a question mark for those that you are interested in
                            but need to research for more information.
                           </p>
                         <p>Explore if the careers match your own dream careers. Narrow down your career choices and research them in detail.
                            If the careers suggested does not match your interest, don’t quickly change your plans. Instead, do some
                            investigation to make sure you understand the career you have chosen and those suggested in this report. No single
                            test or resource can provide you with “one” right choice. Only you can make your career decision. All the best in
                            your future!
                        </p>
                    </div>
                </td>
            </tr>
        <tr>
            <td colspan="2">
                <table>
                    <tbody>
                        <tr>
                            <td colspan="2"><h2 style="margin-top: 25px;"><b>Exploring Occupations</b></h2></td>
                        </tr>
                        @foreach ($occupations as $key => $val)
                            <tr>
                                <td colspan="2">
                                    <div>
                                        <h4 style="text-transform: uppercase;width: 100%;display: flex">{{$key}} OCCUPATIONS</h4>
                                        <ul class="occu-list">
                                            @foreach($val as $k => $item)
                                                @if($key == $item->personalitytype)
                                                    <li>{{$item->occupationen}}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div>
                    <h3>Next Steps</h3>
                    <p>
                        Identify and highlight those careers that may interest you (about 10-15 careers). You may not be
                        familiar with some of the careers, don’t worry, circle it and research about it later. You can do your
                        research by reading books, searching online, reaching out to your network and finding out from those
                        who are working in the industry, familiarizing yourself with the career of your choice, volunteering or
                        getting a temp job in the field you are interested in, attending career fairs and seminars or interviewing
                        industry professionals. Find out as much as you can about those careers that interests you and
                        eliminate those that does not match your requirements.
                    </p>
                    <h4>How do I get more information? </h4>
                            <p>
                            Step 1 : Select about ten careers that you are interested in from your career test report.
                            </p>
                            <p>
                            Step 2 : Go to <a href="https://www.onetonline.org/" target="_blank">https://www.onetonline.org/</a>
                            </p>
                            <p>
                            Step 3: Search for information about the ten careers you have short-listed and read about all ten careers.
                            </p>
                            <p>
                            Step 4: After reading about the ten careers, you may drop a few of them. Your list may get shorter.
                            </p>
                            <p>
                            Step 5: Search for universities that offer courses in the fields that you have selected. Explore the entry requirements, tuition fees, duration of the course, etc.
                            </p>
                            <p>
                            Step 6: Apply to the universities when applications are invited. Once the university issues an offer letter, start to make the necessary preparations.
                            </p>
                            <p>
                            If you are in doubt or need further career guidance, write to : <a href="mailto:enquiry@ark.com.my">enquiry @ark.com.my</a>. Our Career Coach will provide you all the necessary assistance you need. This service is provided FREE to all those who take our online career test.
                            </p>
                            <p>
                            Thank you for taking the Career Preference Test !
                            </p>
                            <p>
                            @ Copyright Ark Publications. All Rights Reserved.
                            </p>
                </div>
                
            </td>
        </tr>
        
    </table>
</div>
</body>
</html>
