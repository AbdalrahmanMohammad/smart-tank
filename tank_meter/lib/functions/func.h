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
  }
  return sum / rounds;
}