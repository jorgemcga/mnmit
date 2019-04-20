# mnmit

Sistema PHP de gerenciamento e monitoramento de ativos de TI (ainda em fase de melhoria).
Management & Monitoring TI Assets PHP System (still in the improvement phase)


To make the monitoring put in a crontab the follow line

<br> 0 * * * * root curl http://server.monitor/monitoramento/run

<br><br> Configure the system constants in app/config.php
<br> The available configurations are SendGrid API , Default System URL, Boot Telegram API and DB Constants
