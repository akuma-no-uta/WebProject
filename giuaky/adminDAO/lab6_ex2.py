import matplotlib.pyplot as plt
import numpy as np
from math import exp, factorial

lambda_poisson = 3
k_values_2 = np.arange(1, 6)
probabilities_2 = [(lambda_poisson**k * exp(-lambda_poisson)) / factorial(k) for k in k_values_2]

plt.bar(k_values_2, probabilities_2, color='lightgreen')
plt.title('Poisson Distribution - Post Office Phone Calls')
plt.xlabel('Number of Calls')
plt.ylabel('Probability')
plt.show()
