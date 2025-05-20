import matplotlib.pyplot as plt
import numpy as np
from math import comb

n = 5  
p = 0.1  
k_values_1 = np.arange(0, 6)
probabilities_1 = [comb(n, k) * (p**k) * ((1 - p)**(n - k)) for k in k_values_1]

plt.bar(k_values_1, probabilities_1, color='skyblue')
plt.title('Binomial Distribution - Factory with 5 Machines')
plt.xlabel('Number of Machines Broken')
plt.ylabel('Probability')
plt.show()







