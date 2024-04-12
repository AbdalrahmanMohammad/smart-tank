# Smart Tank Project

## Overview

This project encompasses a web-based system designed for the monitoring of a tank model, employing the NodeMCU as the primary microcontroller. The system facilitates real-time tracking of the water level percentage within the tank using a series of LEDs integrated into the model. Additionally, it displays the water percentage on a web page by transmitting the values to a database simultaneously.

The system also maintains a log of the tank's states, recording both empty and full occurrences along with timestamps of each incident. Furthermore, it provides email notifications to alert users of any changes in the tank's status.

## Features

- **Real-time Monitoring**: Utilizes NodeMCU to monitor water levels in the tank in real-time.
- **LED Display**: Visualizes water percentage using LEDs mounted on the tank model.
- **Voice Alert**: A buzzer beeps when the tank gets empty or full.
- **Web Interface**: Displays water percentage on a web page, updating in real-time.
- **Database Integration**: Stores water level data in a database for future analysis.
- **State Logging**: Records timestamps of tank states, including empty and full conditions.
- **Email Notifications**: Sends prompt email notifications to users upon changes in tank status.

## Video for the Project
https://www.youtube.com/watch?v=EoJm9L6huuo

## Important note
I only did the microcontroller code and some PHP scripts database control. These components have been integrated with an existing website, which was previously developed. Additionally, I have created the physical model for the project.
