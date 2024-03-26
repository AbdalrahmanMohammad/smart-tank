#include <Arduino.h>
#include <shift_register.h>
#include <Led.h>
#include "HCSR04.h"
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <Arduino_JSON.h>

#define TRIGGER_PIN D1
#define ECHO_PIN D2

WiFiClient client;
const char *ssid = "PL";
const char *password = "87654321";

ShiftRegister reg(D5, D6, D7);
Led leds(&reg, D4, D3);

int buzzer = D8;
int wifiLed = D0;
unsigned long wifiPrevious = 0;
UltraSonicDistanceSensor ultrasonicSensor(TRIGGER_PIN, ECHO_PIN);

String postData = "";
String payload = "";

float maxDistance = 18.7;
float minDistance = 3.5;

float previousReading = 0;

boolean emptyLock = false;
boolean fullLock = false;

boolean firstRound = true;