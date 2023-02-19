import csv
import random

# User defined parameters
file1 = "file1.csv"
file2 = "file2.csv"
outFile = "test.csv"
isRandom = False

output = []
#Open the two files and extract rows in lists.
with open(file1, 'r', newline='') as csvfile1:
    with open(file2, newline='') as csvfile2:
        file1reader = csv.reader(csvfile1, delimiter = ';')
        file2reader = csv.reader(csvfile2, delimiter = ';')
        row1 = []
        row2 = []
        for row in file1reader:
            # print(row)
            row1.append(row)
        for row in file2reader:
            row2.append(row)
        #Shuffle one of the two files if randomization is desired.
        if(isRandom):
            random.shuffle(row2)
        #Concatenates the two files.
        for index in range(len(max(row1, row2))):
            # print(index)
            # print(f"this is: {row2}")
            output.append([*row1[index], *row2[index]])
# print(output)
#Writes the result to an output file.
with open(outFile, 'w', newline='') as csvOutFile:
    outFileWriter = csv.writer(csvOutFile, delimiter = ';')
    outFileWriter.writerows(output)

