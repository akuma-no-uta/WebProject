import matplotlib.pyplot as plt
import numpy as np

p = 0.4
k_values_3 = np.arange(1, 11)
probabilities_3 = [(1 - p)**(k - 1) * p for k in k_values_3]

plt.bar(k_values_3, probabilities_3, color='salmon')
plt.title('Geometric Distribution - Bullets Fired Until Target is Hit')
plt.xlabel('Attempt Number')
plt.ylabel('Probability')
plt.show()