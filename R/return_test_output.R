# library(ggplot2)
# library(dplyr)
# library(patchwork) # To display 2 charts together
# library(hrbrthemes)
# Read command line arguments
args = commandArgs(TRUE)
passed_path = args[1]

pdata = read.csv(passed_path, sep = ';')
pdates = array()
png(filename="test.png", width=1152, height=720)
par(bg=NA)
first = T
for (i in colnames(pdata)) {
  pdata[[i]] = as.Date.character(pdata[[i]],format = "%Y-%m-%d")
  pdata[[i]] = pdata[[i]][order(pdata[[i]])]
  if (first) {
    first = F
    plot(pdata[[i]], 1:length(pdata[[i]]),type="l", xlab = "Date of vaccination administration", ylab = "Number of vaccinated patients")
  }
  else {
    plot(pdata[[i]], 1:length(pdata[[i]]),type="l", xaxt="n", yaxt="n", xlab = "Date of vaccination administration", ylab = "Number of vaccinated patients")
  }
  par(new=TRUE)
}
dev.off()
#n_vax = length(opdates)
#cat("Total number of vaccinations: ", n_vax)