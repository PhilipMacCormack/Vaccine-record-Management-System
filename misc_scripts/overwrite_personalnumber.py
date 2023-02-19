import csv
from queue import Empty
import random
outFile = []
with open("C:\MAMP\htdocs\Catwoman-IMS\db_create\mockdata\patient_v2.csv", 'r') as patientData:
    patientReader = csv.reader(patientData,delimiter=",")
    header = True
    for row in patientReader:
        if(header):
            header = False
        elif (len(row) == 0):
            continue
        else:
            print(row)
            date = row[8]
            date = date.replace("-", "")
            row[0] = f"{date}{str(random.randint(0000,9999)).zfill(4)}"
        outFile.append(row)
with open("C:\MAMP\htdocs\Catwoman-IMS\db_create\mockdata\patient_v3.csv", 'w', newline = "") as patientData:
    patientWriter = csv.writer(patientData)
    patientWriter.writerows(outFile)