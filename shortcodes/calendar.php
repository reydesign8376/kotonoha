<?php
// shortcodes/calendar.php
// [kotonoha_calendar]
function get_kotonoha_calendar()
{
    return <<<HTML
<div class="kotonoha_calendar-section">
<h2>
    <button id="prev-month" aria-label="前の月">＜</button>
    <span id="kotonoha_calendar-title"></span>
    <button id="next-month" aria-label="次の月">＞</button>
</h2>
    <table id="kotonoha_calendar-week">
        <thead>
            <tr>
                <th>日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th>土</th>
            </tr>
        </thead>
        <tbody id="kotonoha_calendar-body"></tbody>
    </table>

    <script>
        const calendarId = '620989080284b65aeb3bdb774bc3fd1070fdb2e9d771267a08502649ebc9e4ce@group.calendar.google.com';
        const apiKey = 'AIzaSyCVWBRLhG39AFF9pQymFBtafo0-60Qkzag';
        const today = new Date();
        const year = today.getFullYear();
        const month = today.getMonth(); // 0-indexed

//日本時間の取得
function formatDateLocal(date) {
    return date.toLocaleDateString('ja-JP', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit'
    }).replace(/\//g, '-');
}
        document.getElementById("kotonoha_calendar-title").textContent = `\${year}年\${month + 1}月`;

        function buildCalendar(events) {
            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            let startDay = firstDay.getDay();
            let totalDays = lastDay.getDate();

            const tbody = document.getElementById("kotonoha_calendar-body");
            tbody.innerHTML = '';
            let row = document.createElement("tr");

            for (let i = 0; i < startDay; i++) {
                row.appendChild(document.createElement("td"));
            }

            for (let date = 1; date <= totalDays; date++) {
                const td = document.createElement("td");
                td.innerHTML = `<strong>\${date}</strong>`;

                const thisDate = new Date(year, month, date);
                const thisDateStr = formatDateLocal(thisDate);

                events.forEach(event => {
                    const start = formatDateLocal(new Date(event.start.date || event.start.dateTime));
                    if (start === thisDateStr) {
                        const div = document.createElement("div");
                        div.className = 'event';

                        const isAllDay = !!event.start.date;
                        let timeText = '';

                        if (!isAllDay) {
                            let startDate = new Date(event.start.dateTime);
                            let endDate = new Date(startDate.getTime() + 60 * 60 * 1000); // 常に1時間後

                            const formatTime = date => date.toLocaleTimeString('ja-JP', {
                                hour: '2-digit',
                                minute: '2-digit'
                            });

                            timeText = `\${formatTime(startDate)}〜\${formatTime(endDate)} `;
                        }

                        div.textContent = `\${timeText}\${event . summary}`;
                        td.appendChild(div);
                    }
                });

                row.appendChild(td);

                if ((startDay + date) % 7 === 0 || date === totalDays) {
                    tbody.appendChild(row);
                    row = document.createElement("tr");
                }
				if (thisDateStr === new Date().toISOString().split('T')[0]) {
    td.classList.add("today");
}
            }
        }

        const startOfMonth = new Date(year, month, 1).toISOString();
        const endOfMonth = new Date(year, month + 1, 0, 23, 59, 59).toISOString();

        const url = `https://www.googleapis.com/calendar/v3/calendars/\${encodeURIComponent(calendarId)}/events?key=\${apiKey}&timeMin=\${startOfMonth}&timeMax=\${endOfMonth}&singleEvents=true&orderBy=startTime`;

        fetch(url)
            .then(res => res.json())
            .then(data => {
                const events = data.items || [];
                buildCalendar(events);
            })
            .catch(err => {
                console.error("カレンダー読み込み失敗:", err);
            });
    </script>
</div>
HTML;
}

add_shortcode('kotonoha_calendar', 'get_kotonoha_calendar');
