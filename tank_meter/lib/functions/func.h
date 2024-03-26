float measure(int num)
{
    float sum = 0;
    float measure;
    int rounds = 0;
    for (int i = 0; i < num; i++)
    {
        measure = ultrasonicSensor.measureDistanceCm();
        if (measure >= 0)
        {
            sum += measure;
            rounds++;
        }
        delay(3);
    }
    return sum / rounds;
}

void connect_wifi()
{
    WiFi.begin(ssid, password);

    Serial.println("Connecting");
    while (WiFi.status() != WL_CONNECTED)
    {
        delay(500);
        Serial.print(".");
    }
    Serial.println("");
    Serial.print("Connected to WiFi network with IP Address: ");
    Serial.println(WiFi.localIP());
}

void checkWifi() // checks wifi connection every 3 seconds and shows the condition on wifiLed
{
    if (millis() - wifiPrevious >= 3000UL)
    {
        if (WiFi.status() == WL_CONNECTED)
        {
            digitalWrite(wifiLed, HIGH);
        }
        else
        {
            digitalWrite(wifiLed, LOW);
        }

        wifiPrevious = millis();
    }
}

void sendReadings(int percentage)
{
    if (percentage == 0) // do not send more than one time in 10 seconds
    {
        if (millis() - previousEmpty < 10000)
            return;

        previousEmpty = millis();
    }

    if (percentage == 10) // do not send more than one time in 10 seconds
    {
        if (millis() - previousFull < 10000)
            return;

        previousFull = millis();
    }

    if (WiFi.status() == WL_CONNECTED)
    {
        HTTPClient http;
        int httpCode;

        String LED_State = "";

        postData = "percentage=" + String(percentage);

        payload = "";
        http.begin(client, "http://192.168.8.55/tank/web/php_codes/newReading.php");
        http.addHeader("Content-Type", "application/x-www-form-urlencoded");
        httpCode = http.POST(postData);
        payload = http.getString(); // return nothing
        http.end();
    }
}

void controlLeds(float distance)
{
    int percantage;
    int level;
    if (abs(distance - previousReading) < 1) // if the difference between two reading is less than 1 CM ignore it
    {
        // Serial.println("returniniing");
        return;
    }

    if (abs(distance - previousReading) > 5) // if the difference is big then it is a falsy reading
    {
        Serial.print("falsy reaaaading : ");
        Serial.println(previousReading);
        if (!firstRound) // this is not the first round of the program
            return;
    }

    if (distance >= maxDistance)
    {
        level = 0;
        percantage = 0;
    }

    else if (distance <= minDistance)
    {
        level = 10;
        percantage = 10;
    }

    else
    {

        float difference = maxDistance - minDistance; // 18.7-3.5= 15,2

        float step = difference / 10; // 10 is the number of leds 15.2/10 = 1.5 (1.5 CM for each led)

        float diff = distance - minDistance;

        if (abs(distance - previousReading) > 3) // to not consider it a new full or empty unless the difference is more than 3 cm
        {
            emptyLock = false;
            fullLock = false;
        }

        if (emptyLock || fullLock) // to not consider it a new full or empty unless the difference is more than 3 cm
            return;

        float noOfOffLeds = diff / step; // number of Off leds
        level = (int)noOfOffLeds;
        level = (level == 0) ? 1 : level;
        level = (level == 10) ? 9 : level;

        percantage = 10 - noOfOffLeds;

        percantage = (percantage == 0) ? 1 : percantage;
        percantage = (percantage == 10) ? 9 : percantage;

        for (int i = 10; i > 10 - noOfOffLeds; i--)
            leds.controlLed(i, LOW);

        for (int i = 1; i <= 10 - noOfOffLeds; i++)
            leds.controlLed(i, HIGH);

        leds.controlLed(10, LOW);
        leds.controlLed(1, HIGH);
    }

    if (level == 0 && emptyLock == false) // to not consider it a new full or empty unless the difference is more than 3 cm
    {
        emptyLock = true;
        leds.allOff();
        digitalWrite(buzzer, HIGH);
        // Serial.println("**************************");
        // Serial.println(previousReading);
        // Serial.println(distance);
        // Serial.println("**************************");

        delay(300);
        digitalWrite(buzzer, LOW);
    }
    else if (level == 10 && fullLock == false) // to not consider it a new full or empty unless the difference is more than 3 cm
    {
        fullLock = true;
        leds.allOn();
        digitalWrite(buzzer, HIGH);
        delay(300);
        digitalWrite(buzzer, LOW);
    }

    Serial.println(percantage * 10);
    sendReadings(percantage * 10);

    previousReading = distance;
    firstRound = false;
}